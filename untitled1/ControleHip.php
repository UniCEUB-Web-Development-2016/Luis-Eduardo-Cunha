<?php
include "Math.php";


$math = new Math();

echo $math ->getHipotenusa($_POST["catetoAdj"],$_POST["catetoOp"]);