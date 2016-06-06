<?php

class Math
{

    private $pi = 3.14159261;

    function fibonacci($position)
    {
        if ($positon == 0)
            return 0;

        if ($positon == 1)
            return 1;

        return fibonacci($position - 1) + fibonacci($positon - 2);
    }

    function circle_area($radius = 2)
    {

        return $this->pi * $radius * $radius;
    }

    function list_circle_area($radius)
    {
        $areas = array();
        foreach ($radius as $r)
        {
            array_push($areas,circle_area($r));

        }
        return $areas;
    }

    public function getHipotenusa($catetoAdj, $catetoOp)
    {
        return sqrt(($catetoAdj * $catetoAdj) + ($catetoOp * $catetoOp));
    }

}

?>
