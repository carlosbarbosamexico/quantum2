/**
 * QLoader a tiny but powerful js loader;
 * 
 * @author Carlos Barbosa
 * @namespace {QLoader} 
 * @private
 */
if (!window.QLoader){

    (function(window) {
        
        window.QLoader = (function() {
            
            var elementsLoaded = 0,
            _scripts = [],
            _postLoadCalls = [];
            
            var api = {
                
                /**
                 * QLoader.init(sources, callback) -
                 * Initialize a QLoader object
                 * Add scripts to it, and define a callback when done
                 *
                 * @param {array} srcs The js files to load;
                 * @param {function} callback The callback to execute when load is complete
                 */
                init: function(srcs, fn) {
                    cleanUp();
                    _scripts = srcs;
                    addReadyCall(fn);
                },

                /**
                 * QLoader.js(url, callback)
                 * Load a single js file and execute a callback when done
                 *
                 * @namespace {QLoader} 
                 * @param {string} url A url to call;
                 * @param {function} callback The callback to execute when load is complete
                 */
                js: function(url, callback) {
                    return loadScript(url, callback);
                },

                /**
                 * QLoader.plugin(name, callback);
                 * Register a plugin in the plugin api, will be accessed at QLoader.nameOfPlugin
                 *
                 * @namespace {QLoader}
                 * @param {string} moduleName The name of the plugin that will be attached to
                 * the QLoad object
                 * @param {function} callback The callback to attach to the method
                 */
                plugin: function(_name, _callback) {
                    Plugin.register(_name, _callback);
                },

                /**
                 * QLoader.load(mode)
                 * Trigger load of the files added via init or addSource
                 *
                 * @namespace {QLoader}
                 * @param {string} mode The mode to load, default to in js order
                 * add 'async' for asynchronous loading.
                */
                load: function(mode) {
                    triggerLoad(mode);
                },

                /**
                 * QLoader.addSource(source)
                 * Add a single js file to the loading array
                 *
                 * @namespace {QLoader}
                 * @param {string} source The file to load
                */
                addSource: function(source) {
                    _scripts.push(source);
                },

                /**
                 * QLoader.addPostLoadCall(function)
                 * Add a function to execute when load is complete.
                 *
                 * @namespace {QLoader}
                 * @param {function} callback = The function to execute;
                */
                addPostLoadCall: function(callback) {
                    addReadyCall(callback);
                },

                /**
                 * QLoader.ready(function)
                 * Add a function to execute when load is complete.
                 *
                 * @namespace {QLoader}
                 * @param {function} callback = The function to execute;
                */
                ready: function(callback) {
                    addReadyCall(callback);
                }

            };
           
            var createLoadingObject = function(url, callback) {

                var _loader = {};
                _loader.url = url;
                _loader.callback = callback;
                _loader.loadComplete = false;
                _loader.abort = false;
                
                _loader.done = function() {
                    _loader.loadComplete = true;
                    _loader.code = 200;
                    _loader.success = true;
                };
                return _loader;
            };

            var loadScript = function(url, callback) {
                
                if (!url) { return false; }
                
                var loader = createLoadingObject(url, callback);
                var head = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = url;

                script.onload = script.onreadystatechange = function() {

                    if (!script.readyState || /loaded|complete/.test(script.readyState)) {

                        script.onload = script.onreadystatechange = null;

                        if (head && script.parentNode) {
                            head.removeChild(script);
                        }

                        script = undefined;

                        if (!loader.abort && callback) {
                            loader.done();
                            callback(loader);
                        }
                        if (loader.abort) {
                            cleanUp();
                        }
                    }
                };

                head.insertBefore(script, head.firstChild);

                return loader;

            };

            var syncElementLoaded = function() {
                
                elementsLoaded = elementsLoaded + 1;
                if (elementsLoaded >= _scripts.length) {
                    loadComplete();
                    
                } else {
                    triggerLoad();
                }
            };

            var asyncElementLoaded = function() {

                elementsLoaded = elementsLoaded + 1;
                if (elementsLoaded >= _scripts.length) {
                    loadComplete();
                }
            };

            var loadComplete = function() {
                executePostLoadCalls();
                cleanUp();
            };

            var cleanUp = function() {
                elementsLoaded = 0;
                _scripts.length = 0;
                _postLoadCalls.length = 0;
            };

            var run = function(callback) {
                
                if (typeof callback === 'function' && !callback.done) {
                   callback.call();
                   callback.done = true;
                }
                
            };
            
            var addReadyCall = function(_fn) {
                
                if (typeof(_fn) === 'function') {
                    _postLoadCalls.push(_fn);
                }
                
            };


            var triggerLoad = function(mode) {
                
                if (mode === 'async') {
                    for (var i = 0; i < _scripts.length; i++) {
                        loadScript(_scripts[i], asyncElementLoaded);
                    }
                }
                else {
                        loadScript(_scripts[elementsLoaded], syncElementLoaded);
                }
                
                    
            };

            var executePostLoadCalls = function() {

                if (_postLoadCalls !== undefined && _postLoadCalls.length > 0) {

                    for (var i = 0; i < _postLoadCalls.length; i++) {
                       run(_postLoadCalls[i]);
                    }
                }

            };

            var Plugin = {
               
                register: function(name, callback) {
                    if (typeof name === 'string' && typeof callback === 'function') {
                    api[name] = callback;
                    for (var i=0; i < Plugin.api.length; i++) {
                        var x = Plugin.api[i];
                        api[name][x.name] = x.callback;
                        }
                    }  
               
                },
                
                api: [
                    
                    this.createLoader = {
                    
                        name:'createLoader',
                        callback:function(url, callback) {
                            return createLoadingObject(url, callback);
                        }
                    }
                    
                ]
            };
            
            return api;
        }());
    })(window);

}

QLoader.plugin('require', function(srcs, mode, callback) {
                    
        if (typeof mode === 'string' && mode === 'async') {
            QLoader.init(srcs, function() {
                if (callback && typeof callback === 'function') {
                    callback.call();
                }
            });
            QLoader.load(mode);
        }
        
        if (typeof mode === 'function') { 
            QLoader.init(srcs, function() {
                if (mode && typeof mode === 'function') {
                    mode.call();
                }
            });
            QLoader.load();
        }
        
        if (srcs !== undefined && mode === undefined && callback === undefined) {
            QLoader.init(srcs, function() {
                
            });
            QLoader.load();
        }
                    
});


QLoader.plugin('define', function(moduleName, srcs, callback) {
                    
        if (typeof moduleName !== 'string') {
            return;
        }
        
        if (srcs instanceof Array && callback) {
            QLoader.init(srcs, function() {
                window[moduleName] = moduleName;
                if (typeof callback === 'function') {
                    callback.call();
                }
            });
            QLoader.load();
            
        }
        
       
});

QLoader.plugin('loadCss', function(url, callback){
        
            var i = this.loadCss;
                
            var _loader = i.createLoader(url, callback);
            if(document.createStyleSheet) {
                try {document.createStyleSheet(url);} catch (e) { }
            }
            else{
                var css;
                css         = document.createElement('link');
                css.rel     = 'stylesheet';
                css.type    = 'text/css';
                css.media   = "all";
                css.href    = url;
                document.getElementsByTagName("head")[0].appendChild(css);
            }
            _loader.done();
            callback(_loader);
           
});

QLoader.plugin('addProfile', function(profileName, sources) {
    
    profile = {};
    profile.name = profileName;
    profile.sources = sources;

    profiles = [];
    profiles.push(profile);
    this.profiles = profiles;
    console.log(this);
});