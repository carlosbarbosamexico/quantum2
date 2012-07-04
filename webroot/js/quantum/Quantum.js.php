<?php
//
// Copyright Quantum Foundation.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

$JS_FILES = array(
  'lib/json2.js',
  'core/prelude.js',
  'common/type.js',
  'common/array.js',
  'common/type.js',
  'common/event.js',
  'common/obj.js',
  'common/dom.js',
  'common/string.js',
  'common/anim.js',
  'core/json.js',
  'app/app.js'
  
  
);

header ('Content-type: text/javascript');

foreach ($JS_FILES as $file) {
  echo file_get_contents($file);
}


