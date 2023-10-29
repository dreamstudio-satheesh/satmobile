const staticCacheName = 'precache-v3.0.1';
const dynamicCacheName = 'runtimecache-v3.0.1';

// Pre Caching Assets
const precacheAssets = [
    '/',
    '/img/core-img/logo-small.png',
    '/img/core-img/logo-white.png',
    '/img/bg-img/no-internet.png',
    '/js/theme-switching.js',
    '/offline.html'
];

// Install Event
/* self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(staticCacheName).then(function (cache) {
            return cache.addAll(precacheAssets);
        })
    );
}); */

// Install Event
self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(staticCacheName).then(function (cache) {
            return Promise.all(
                precacheAssets.map(function (url) {
                    return fetch(url)
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('Failed to fetch: ' + url);
                            }
                            return cache.put(url, response);
                        })
                        .catch(function (error) {
                            console.error('Failed to fetch resource:', error);
                        });
                })
            );
        })
    );
});


// Activate Event
self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName && key !== dynamicCacheName)
                .map(key => caches.delete(key))
            );
        })
    );
});

// Fetch Event
self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(cacheRes => {
            return cacheRes || fetch(event.request).then(response => {
                // Check if the response is valid before caching
                if (response && response.status === 200) {
                    return caches.open(dynamicCacheName).then(function (cache) {
                        cache.put(event.request, response.clone());
                        return response;
                    });
                } else {
                    // Handle non-200 responses here
                    return response;
                }
            }).catch(function() {
                // Fallback Page, When No Internet Connection
                return caches.match('/offline.html');
            });
        })
    );
});
