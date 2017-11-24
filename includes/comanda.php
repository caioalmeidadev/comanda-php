<center>
<?php

    $mesa = new \acme\models\comandaModel();
    $mesas = $mesa->mesasOcupadas();

function defineMesa($numMesa,$status)
{
    if($status == 'ocupado')
    {
        echo '<div class="column">
                        <a href="?p=consumo&cod_mesa='.$numMesa.'" class="ui red button">
                         <i class="check blue icon"></i>' . $numMesa . '
                        </a>
                     </div>';
    }
    else
    {
        echo '<div class="column">
                        <a href="?p=consumo&cod_mesa='.$numMesa.'" class="ui green button">
                         <i class="check blue icon"></i>' . $numMesa . '
                        </a>
                     </div>';
    }
}



?>

<div class="ui stackble four column grid">
    <?php

    $i = 0;
    $x = [];
    $j = 1;
    $p = '';

    foreach($mesas as $key => $mesa)
    {
        $x[$key]=$mesa->COD_MESA;


    }

    if(count($x) < $numeroMesas)
    {
        $k = count($x);
        do {

                $x[$k] = 0;

            $k++;

        }while($k <= $numeroMesas);

    }

        while ($j <= $numeroMesas) {


            $p = $x[$i];


            if ($p == $j) {

                    defineMesa($j,'ocupado');
                    ++$i;



            }
            elseif($p == null||$p =='')
            {
                defineMesa($j,'livre');
            }
            else {
                defineMesa($j,'livre');

            }
            $j++;


        }



    ?>


</div>