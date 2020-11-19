<?php

if (!empty($_POST['checked']) && !empty($_POST['dataBarra'])){
    $checked = $_POST['checked'];
    $dataBarra = $_POST['dataBarra']; 
    
    // print_r($checked);
    // echo "";
    // print_r($dataBarra);

    $dataFiltrada = array();
    foreach ($dataBarra as $key => $value) {
        # code...
        if(empty($value)){
            continue;
        }
        $array = array();
            // print_r($key);
        $array['zona'] = $value['zona'];
        // $array['Llegada'] = intval($value['Llegada']);
        foreach ($value as $llave => $valor) {

            foreach( $checked as $check) {
                if($check == $llave ){
                    // echo "check: ".$check;
                    // echo "\n";
                    $array[str_replace(' ', '', $llave)] = intval($valor);

                }
                    
            }
            
        }
        // print_r($array);
        $dataFiltrada[] = $array;
    }
    
    echo json_encode($dataFiltrada);

}
else
{
    echo json_encode([]);
    // return;
}