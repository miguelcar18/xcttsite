<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Documento sin t�tulo</title>
		<link href="../css/alert.min_mensaje.css" rel="stylesheet"/>
		<link href="../css/theme.min_mensaje.css" rel="stylesheet"/>
		<script src="../js/jquery_mensaje.js"></script>
		<script src="../js/jquery-ui_mensaje.js"></script>
		<script src="../js/alert.min_mensaje.js"></script>
    </head>
    <body>

<?php
            include("funciones_mysql.php");
            $conn=conectar();
            
            if (!empty($_POST['nick']) && !empty($_POST['password']))
            {
                $usu=$_POST['nick'];
                $clav=crypt($_POST['password'],"2A");
                $STRINGINGRESO="select * from usuario where nick_usuario='".$usu."'";
                $SQLINGRESO=mysql_query($STRINGINGRESO);
                $FILASINGRESO=mysql_num_rows($SQLINGRESO);

                if($FILASINGRESO==1)
                {
                    for($is=1;$is<=$FILASINGRESO;$is++)
                    {
                        $rs=mysql_fetch_array($SQLINGRESO);
                        $nick_usuario=$rs['nick_usuario'];
                        $clave_usuario=$rs['clave_usuario'];
                        $nombre_usuario=$rs['nombre_usuario'];
                        $habilitado=$rs['enabled'];
                        if($clav==$clave_usuario && $habilitado==0)
                        {
                            ?>
                            <script>
					$(document).ready(function(){
		$.alert.open({
		title: 'ADVERTENCIA',
		icon: 'warning',
		content: 'Por favor, revise su correo electronico y valide su registro.',
		callback: function() {
				history.go(-1);
			}
		});
		});
            </script>
                            <?php
                        }
                        
                        else if($clav==$clave_usuario && $habilitado==1)
                        {
                            /*session_start();
                            $_SESSION['nick_usuario']=$nick_usuario;
                            $_SESSION['clave_usuario']=$clave_usuario;
                            $_SESSION['nombre_usuario']=$nombre_usuario;
                            $_SESSION['cedula_usuario']=$cedula_usuario;
                            $_SESSION['tipo_usuario']=$tipo_usuario;
                            $_SESSION['placa_usuario']=$placa_usuario;*/
                             ?>
                            <script>
                                // Creamos un objeto
                                var object = { 'nick_u' : '<?php echo $nick_usuario?>', 'clave_u' : '<?php echo $clave_usuario?>', 'nombre_u' : '<?php echo $nombre_usuario?>'};
                                // Lo guardamos en localStorage pasandolo a cadena con JSON
                                localStorage.setItem('key', JSON.stringify(object));
                            </script>
                            <?php
                            pasar("../PagPersonal.html");
                        }
                        else
                        {
                            ?>
                            <script>
								$(document).ready(function(){
		$.alert.open({
		title: 'ERROR',
		icon: 'error',
		content: 'La contrase�a ingresada es incorrecta',
		callback: function() {
				history.go(-1);
			}
		});
		});
                            </script>
                            <?php
                        }
                    }
                }
                else 
                {
                    ?>
                    <script>
								$(document).ready(function(){
		$.alert.open({
		title: 'ERROR',
		icon: 'error',
		content: 'Usuario inv�lido.',
		callback: function() {
				history.go(-1);
			}
		});
		});
                    </script>
                    <?php
                }
            }
        ?>
</body>
</html>