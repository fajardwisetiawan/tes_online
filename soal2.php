<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        String.prototype.reverse=function(){
            return this.split("").reverse().join("");
        }
    </script>
    <style>
        body { background-color: #ebebeb; }
    </style>
</head>
<body>

<div class="container">
  <h2>Simpel App</h2>
    <div class="form-group" id="content">
      <input type="text" class="form-control" placeholder="Masukkan Text" value="" id="message">
    </div>
    <div class="form-group">
        <p style="font-size:30px;"> Output: <strong><span id="display_message"></span></strong> </p>
    </div>
    <div id="buttons">
        <input type="submit" class="btn btn-primary" onclick="showMessage()" value="Reverse" />
        <button type="button" class="btn btn-primary" id="unre_btn">Undo/Redo</button>
    </div>
</div>

<script type="text/JavaScript">
    function showMessage(){
        var message =  document.getElementById('display_message').innerHTML = document.getElementById('message').value.reverse();
        display_message.innerHTML= message;
    }
</script>

<script type="text/javascript">
  var StateUndoRedo = function() {
      var init = function(opts) {
         var self = this;
         self.opts = opts;
         if(typeof(self.opts['restore']) == 'undefined') {
            self.opts['restore'] = function() {};
         }
      }

      var add = function(state) {
         var self = this;
         if(typeof(self.states) == 'undefined') {
            self.states = [];
         }
         if(typeof(self.state_index) == 'undefined') {
            self.state_index = -1;
         }
         self.state_index++;
         self.states[self.state_index] = state;
         self.states.length = self.state_index + 1;
      }

      var undo = function() {
         var self = this;
         if(self.state_index > 0) {
            self.state_index--;

            self.opts['restore'](self.states[self.state_index]);
         }
      }

      var redo = function() {
         var self = this;
         if(self.state_index < self.states.length) {
            self.state_index++;

            self.opts['restore'](self.states[self.state_index]);
         }
      }

      var restore = function() {
         var self = this;
         self.opts['restore'](self.states[self.state_index]);
      }

      var clear = function() {
         var self = this;
         self.state_index = 0;
      }

      return {
         init: init,
         add: add,
         undo: undo,
         redo: redo,
         restore: restore,
         clear: clear
      };
   };

   var o = new StateUndoRedo();
   o.init({
      'restore': function(state) {
         document.getElementById("content").innerHTML = state;
      }
   });

   o.add(document.getElementById("content").innerHTML);
   o.restore();
   o.clear();

   document.getElementById("unre_btn").addEventListener("click", function() {
      o.undo();
   });
   $("#unre_btn").dblclick(function(){
         o.redo();
   });

  document.getElementById('content').addEventListener("change", function(event) {
      var elems = document.querySelectorAll("#content input");
      for(var i = 0; i < elems.length; i++) {
         elems[i].setAttribute("value", elems[i].value);
      }

      o.add(document.getElementById("content").innerHTML);
   });
</script>

</body>
</html>