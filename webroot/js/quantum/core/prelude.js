/**
 * Copyright Quantum Foundation.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *
 *
 * @provides fbp.prelude
 */

/**
 * Prelude.
 *
 *     Namespaces are one honking great idea -- let's do more of those!
 *                                                            -- Tim Peters
 *
 * The Prelude is what keeps us from being messy. In order to co-exist with
 * arbitary environments, we need to control our footprint. The one and only
 * rule to follow here is that we need to limit the globals we introduce. The
 * only global we should every have is ``Quantum``. This is exactly what the prelude
 * enables us to do.
 *
 * The main method to take away from this file is `Quantum.copy()`_. As the name
 * suggests it copies things. Its powerful -- but to get started you only need
 * to know that this is what you use when you are augmenting the Quantum object. For
 * example, this is skeleton for how ``Quantum.Event`` is defined::
 *
 *   Quantum.provide('Event', {
 *     subscribe: function() { ... },
 *     unsubscribe: function() { ... },
 *     fire: function() { ... }
 *   });
 *
 * This is similar to saying::
 *
 *   Quantum.Event = {
 *     subscribe: function() { ... },
 *     unsubscribe: function() { ... },
 *     fire: function() { ... }
 *   };
 *
 * Except it does some housekeeping, prevents redefinition by default and other
 * goodness.
 *
 * .. _Quantum.copy(): #method_Quantum.copy
 *
 * @class Quantum
 * @static
 * @access private
 */
if (!window.Quantum) {
  Quantum = {
    // use the init method to set these values correctly
    _apiKey     : null,
    _session    : null,
    _userStatus : 'unknown', // or 'notConnected' or 'connected'

    // logging is enabled by default. this is the logging shown to the
    // developer and not at all noisy.
    _logging: true,
    _inCanvas: (
      (window.location.search.indexOf('fbp_sig_in_iframe=1') > -1) ||
      (window.location.search.indexOf('session=') > -1)),


    //
    // DYNAMIC DATA
    //
    // the various domains needed for using Connect
    _domain: {
      api      : false
      
    },
    _locale: null,
    _localeIsRtl: false,


    /**
     * Copies things from source into target.
     *
     * @access private
     * @param target    {Object}  the target object where things will be copied
     *                            into
     * @param source    {Object}  the source object where things will be copied
     *                            from
     * @param overwrite {Boolean} indicate if existing items should be
     *                            overwritten
     * @param tranform  {function} [Optional], transformation function for
     *        each item
     */
    copy: function(target, source, overwrite, transform) {
      for (var key in source) {
        if (overwrite || typeof target[key] === 'undefined') {
          target[key] = transform ? transform(source[key]) :  source[key];
        }
      }
      return target;
    },

    /**
     * Create a namespaced object.
     *
     * @access private
     * @param name {String} full qualified name ('Util.foo', etc.)
     * @param value {Object} value to set. Default value is {}. [Optional]
     * @return {Object} The created object
     */
    create: function(name, value) {
      var node = window.Quantum, // We will use 'Quantum' as root namespace
      nameParts = name ? name.split('.') : [],
      c = nameParts.length;
      for (var i = 0; i < c; i++) {
        var part = nameParts[i];
        var nso = node[part];
        if (!nso) {
          nso = (value && i + 1 == c) ? value : {};
          node[part] = nso;
        }
        node = nso;
      }
      return node;
    },

    /**
     * Copy stuff from one object to the specified namespace that
     * is Quantum.<target>.
     * If the namespace target doesn't exist, it will be created automatically.
     *
     * @access private
     * @param target    {Object|String}  the target object to copy into
     * @param source    {Object}         the source object to copy from
     * @param overwrite {Boolean}        indicate if we should overwrite
     * @return {Object} the *same* target object back
     */
    provide: function(target, source, overwrite) {
      // a string means a dot separated object that gets appended to, or created
      return Quantum.copy(
        typeof target == 'string' ? Quantum.create(target) : target,
        source,
        overwrite
      );
    },

    /**
     * Generates a weak random ID.
     *
     * @access private
     * @return {String} a random ID
     */
    guid: function() {
      return 'f' + (Math.random() * (1<<30)).toString(16).replace('.', '');
    },

    /**
     * Logs a message for the developer if logging is on.
     *
     * @access private
     * @param args {Object} the thing to log
     */
    log: function(args) {
      if (Quantum._logging) {
        //TODO what is window.Debug, and should it instead be relying on the
        //     event fired below?
//#JSCOVERAGE_IF 0
        if (window.Debug && window.Debug.writeln) {
          window.Debug.writeln(args);
        } else if (window.console) {
          window.console.log(args);
        }
//#JSCOVERAGE_ENDIF
      }

      // fire an event if the event system is available
      if (Quantum.Event) {
        Quantum.Event.fire('fbp.log', args);
      }
    },

    /**
     * Shortcut for document.getElementById
     * @method $
     * @param {string} DOM id
     * @return DOMElement
     * @access private
     */
    $: function(id) {
      return document.getElementById(id);
    }
  };
}
