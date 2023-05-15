<html>
    <head>
        <title>Obfuscation JS</title>

          <script type="text/javascript">

              pass = '%45%74%68%69%63%61%6C%48%61%63%6B%69%6E%67';
              h = window.prompt('Entrez le mot de passe / Enter password');
              if(h == unescape(pass)) {
                  alert('Password accepté, vous pouvez valider le challenge avec ce mot de passe.\nYou an validate the challenge using this pass.');
              } else {
                  alert('Mauvais mot de passe / wrong password');
              }

              /* ]]> */
          </script>
    </head>
    <body>
    </body>
</html>
