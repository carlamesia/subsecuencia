<?php

$T=0;
$N=0;
$max=1000;
$Aa = array();
$Aw = array();
$weight = array();
$maxSize = array();
$maxWeight = array();
$sequence = array();
$peso = array();


include ('/class/class_weight');

for($z=1;$z<=5;$z++) {
    $maxSize[$z] = 0;
    $maxWeight[$z] = 0;
}





if( !empty($_GET['N'])) {

    $T=$_GET['T'];
    $N=$_GET['N'];

    for($j=1; $j<=$T; $j++) {

        $nameS="sequence".$j;
        $nameP="peso".$j;
        $sequence[$j]=$_GET[$nameS];
            $peso[$j]=$_GET[$nameP];

/* Ejemplo con el que se trabajo Resultado 150
        $sequence1 = "1 2 3 4 1 2 3 4 1 2 3 4";
        $peso1 = "10 20 30 40 15 45 20 50 5 25 30 60";
*/
        $numbers = explode(" ", $sequence[$j]);
        $ws = explode(" ", $peso[$j]);

        for ($i = 0; $i < $N; $i++) {

            $Aa[$i+1] = $numbers[$i];
            $Aw[$i+1] = $ws[$i];
        }

        $getWeight = new maxWeight;

        $maxSize[$j] = $getWeight->getMaxSize($N, $Aa, $Aw);
        $maxWeight[$j] = $getWeight->getMaxWeight($max);

    }

}

?>

<head>
    <title>Máximo Peso de Subsecuencias</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/style_s.css" type="text/css" media="screen">


    <script src="js/functions.js" type="text/javascript"></script>
    <script type="text/javascript">

    /* Función en JS que valida el formulario antes de enviarlo*/
        function validar() {

            textoN = document.getSequence.N.value;
            selectT = document.getSequence.T.value;

            arrayS1 = document.getSequence.sequence1.value;
            arrayP1 = document.getSequence.peso1.value;
            arrayS2 = document.getSequence.sequence2.value;
            arrayP2 = document.getSequence.peso2.value;
            arrayS3 = document.getSequence.sequence3.value;
            arrayP3 = document.getSequence.peso3.value;
            arrayS4 = document.getSequence.sequence4.value;
            arrayP4 = document.getSequence.peso4.value;
            arrayS5 = document.getSequence.sequence5.value;
            arrayP5 = document.getSequence.peso5.value;


            if (textoN == "") {
                alert('Debe ingresar la cantidad de números de secuencia');
                document.getSequence.N.value="";
                document.getSequence.N.focus();

            }else {
                for (var i = 1; i <= selectT; i++) {
                    nameS = "sequence" + i;
                    nameP = "peso" + i;

                    if (document.getElementById(nameS).value == "") {
                        alert("Debe ingresar la secuencia " + i);
                        document.getElementById(nameS).value = "";
                        document.getElementById(nameS).focus();


                    }else{
                        if (document.getElementById(nameP).value == "") {
                            alert("Debe ingresar el peso " + i);
                            document.getElementById(nameP).value = "";
                            document.getElementById(nameP).focus();
                        }else{
                            document.getSequence.submit();
                        }
                                           }
                }
            }

        }

    /* Función en JS que valida la caja de textp N como entero */

        function valN(number){

            if (number == "") {
                alert('Debe ingresar la cantidad de números de secuencia');
                document.getSequence.N.value="";
                document.getSequence.N.focus();
            }else {
                if (!/^([0-9])*$/.test(number)) {
                    alert("El valor " + number + " no es un número");
                    document.getSequence.N.value="";
                    document.getSequence.N.focus();
                }else{
                    if(number>150000){
                        alert("El N ingresado no debe ser mayor de 150000");
                        document.getSequence.N.value="";
                        document.getSequence.N.focus();
                    }
                }

            }
        }

    /* Función en JS que limpia el formulario */

        function clean(){
            selectT = document.getSequence.T.value;
            document.getSequence.N.value="";
            document.getSequence.N.focus()

            for (var i = 1; i <= selectT; i++) {
                nameS = "sequence" + i;
                nameP = "peso" + i;
                document.getElementById(nameS).value = "";
                document.getElementById(nameP).value = "";
            }
            document.getSequence.submit();
        }

    /* Función en JS que valida todas las secuencias de números y pesos del formulario */

        function valSequence(sequence, name){
            textoN = document.getSequence.N.value;
            separador = " ";

            if (textoN == "") {
                alert('Debe ingresar la cantidad de números de secuencia');
                document.getSequence.N.value="";
                document.getSequence.N.focus();
            }else {
                                   getNum = sequence.split(separador);
                                for (var i = 0; i < getNum.length; i++) {
                                    if (!/^([0-9])*$/.test(getNum[i])) {
                                        alert("El valor " + getNum[i] + " no es un número");
                                        document.getElementById(name).value = "";
                                        document.getElementById(name).focus();

                                    } else {
                                        max=100000;
                                       if(parseInt(getNum[i])>max) {
                                           alert("Ninguno de los números ingresados debe ser mayor de 100 000");
                                           document.getElementById(name).value = "";
                                           document.getElementById(name).focus();
                                       }
                                    }
                                }

                                if (getNum.length<textoN || getNum.length<textoN){
                                    alert("Los numeros ingresados no coinciden con N");
                                    document.getElementById(name).value = "";
                                    document.getElementById(name).focus();
                                }



            }

        }

    /* Función en JS que habilita o deshabilita cajas de texto de acuerdo al Select seleccionado */

        function actBox(value) {
            if (value == 1) {
                document.getSequence.sequence2.disabled=true
                document.getSequence.peso2.disabled=true
                document.getSequence.sequence3.disabled=true
                document.getSequence.peso3.disabled=true
                document.getSequence.sequence4.disabled=true
                document.getSequence.peso4.disabled=true
                document.getSequence.sequence5.disabled=true
                document.getSequence.peso5.disabled=true           }

            if (value == 2) {
                document.getSequence.sequence2.disabled=false
                document.getSequence.peso2.disabled=false
                document.getSequence.sequence3.disabled=true
                document.getSequence.peso3.disabled=true
                document.getSequence.sequence4.disabled=true
                document.getSequence.peso4.disabled=true
                document.getSequence.sequence5.disabled=true
                document.getSequence.peso5.disabled=true           }
            if (value == 3) {
                document.getSequence.sequence2.disabled=false
                document.getSequence.peso2.disabled=false
                document.getSequence.sequence3.disabled=false
                document.getSequence.peso3.disabled=false
                document.getSequence.sequence4.disabled=true
                document.getSequence.peso4.disabled=true
                document.getSequence.sequence5.disabled=true
                document.getSequence.peso5.disabled=true
            }
            if (value == 4) {
                document.getSequence.sequence2.disabled=false
                document.getSequence.peso2.disabled=false
                document.getSequence.sequence3.disabled=false
                document.getSequence.peso3.disabled=false
                document.getSequence.sequence4.disabled=false
                document.getSequence.peso4.disabled=false
                document.getSequence.sequence5.disabled=true
                document.getSequence.peso5.disabled=true
            }
            if (value == 5) {
                document.getSequence.sequence2.disabled=false
                document.getSequence.peso2.disabled=false
                document.getSequence.sequence3.disabled=false
                document.getSequence.peso3.disabled=false
                document.getSequence.sequence4.disabled=false
                document.getSequence.peso4.disabled=false
                document.getSequence.sequence5.disabled=false
                document.getSequence.peso5.disabled=false
            }

        }
    </script>
</head>

<body  bgcolor="#7fffd4">
<div class="bg1">
    <div class="main1">
        <section id="content">
            <div class="padding">
                <div class="indent">

<form name="getSequence" name="getSequence" action="http://localhost:63342/subsequence/index.php" method="get" enctype="multipart/form-data">
    <fieldset>

        <table style="width:50%" align="center">
            <caption> <h2 class="p0">Máximo Peso de Subsecuencias</h2></caption>


            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td >T: Número de secuencias </td>
                <td>
                    <SELECT name="T" id="T" onchange="actBox(this.value)" >
                        <OPTION VALUE="1">1</OPTION>
                        <OPTION VALUE="2" <?php  if ($T==2){echo "selected";} ?>>2</OPTION>
                        <OPTION VALUE="3" <?php  if ($T==3){echo "selected";} ?>>3</OPTION>
                        <OPTION VALUE="4" <?php  if ($T==4){echo "selected";} ?>>4</OPTION>
                        <OPTION VALUE="5" <?php  if ($T==5){echo "selected";} ?>>5</OPTION>
                    </SELECT>
                </td>
            </tr>
            <tr>
                <td>N: Cantidad de números por secuencia</td>
                <td><input type="text" name="N" value="<?php  if ($N>0) {echo $N;} ?>" size="5%" onchange="valN(this.value);"> <a>1 < N <= 150000</a></td>
            </tr>
            <tr >
                <td>Ingrese Secuencia 1:</td>
                <td >
                    <input type="text" name="sequence1" id="sequence1" value="<?php  if (!empty($sequence[1])) {echo $sequence[1];} ?>" width="50%"  onchange="valSequence(this.value, this.name);">

                </td>
            </tr>
            <tr >
                <td>Ingrese Peso 1:<br> </br></td>
                <td >
                    <input type="text" name="peso1" id="peso1" value="<?php  if (!empty($peso[1])) {echo $peso[1];} ?>" width="50%" onchange="valSequence(this.value, this.name);"><br>
                    <a><?php  if ($maxWeight[1]>0) {echo "Max Weight 1: ".$maxWeight[1];} ?></a></br>

                </td>
            </tr>
            <tr >
                <td>Ingrese secuencia 2:</td>
                <td >
                    <input type="text" name="sequence2" id="sequence2" value="<?php  if (!empty($sequence[2])) {echo $sequence[2];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);">

                </td>
            </tr>
            <tr >
                <td>Ingrese Peso 2:<br> </br></td>
                <td >
                    <input type="text" name="peso2" id="peso2" value="<?php  if (!empty($peso[2])) {echo $peso[2];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);"><br>
                    <a><?php  if ($maxWeight[2]>0) {echo "Max Weight 2: ".$maxWeight[2];} ?></a></br>

                </td>
            </tr>
            <tr >
                <td>Ingrese secuencia 3:</td>
                <td >
                    <input type="text" name="sequence3" id="sequence3" value="<?php  if (!empty($sequence[3])) {echo $sequence[3];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);">

                </td>
            </tr>
            <tr >
                <td>Ingrese Peso 3:<br> </br></td>
                <td >
                    <input type="text" name="peso3" id="peso3" value="<?php  if (!empty($peso[3])) {echo $peso[3];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);"><br>
                    <a><?php  if ($maxWeight[3]>0) {echo "Max Weight 3: ".$maxWeight[3];} ?></a></br>

                </td>
            </tr>
            <tr >
                <td>Ingrese secuencia 4:</td>
                <td >
                    <input type="text" name="sequence4" id="sequence4" value="<?php  if (!empty($sequence[4])) {echo $sequence[4];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);">
                </td>
            </tr>
            <tr >
                <td>Ingrese Peso 4:<br> </br></td>
                <td >
                    <input type="text" name="peso4" id="peso4" value="<?php  if (!empty($peso[4])) {echo $peso[4];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);"><br>
                    <a><?php  if ($maxWeight[4]>0) {echo "Max Weight 4: ".$maxWeight[4];} ?></a></br>

                </td>
            </tr>
            <tr >
                <td>Ingrese secuencia 5:</td>
                <td >
                    <input type="text" name="sequence5" id="sequence5" value="<?php  if (!empty($sequence[5])) {echo $sequence[5];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);">

                </td>
            </tr>
            <tr >
                <td>Ingrese Peso 5:<br> </br></td>
                <td >
                    <input type="text" name="peso5" id="peso5" value="<?php  if (!empty($peso[5])) {echo $peso[5];} ?>" width="50%" disabled="true" onchange="valSequence(this.value, this.name);"><br>
                    <a><?php  if ($maxWeight[5]>0) {echo "Max Weight 5: ".$maxWeight[5];} ?></a></br>

                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"class="buttons"><a class="button-2"  onclick ="clean()" href="#">Limpiar</a><a class="button-2"  onclick ="validar()" href="#">Calcular Peso Máximo</a></td>
            </tr>


        </table>
    </fieldset>
</form>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>