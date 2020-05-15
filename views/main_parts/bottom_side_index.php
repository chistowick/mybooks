<!--Bottom part of the main template-->

</div><!--End content -->
</div><!--End wrapper -->
<div id="footer"><p id="copy">&copy; 2020 Анатолий Чиняев</p></div>

<?php
// Include scripts in the following format 
// <script src='path_to_script.js'></script> 
$scripts = isset($scripts) ? $scripts : false;

if ($scripts) {

    foreach ($scripts as $script) {

        echo $script;
    }
}
?>   

</body>
</html>