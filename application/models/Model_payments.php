<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class model_payments extends CI_Model {



  function __construct(){

    parent::__construct();

  }

  public function consulta_correo($dia,$id_usuario){
    $sql="SELECT * FROM master_correos_negocio mcn where mcn.id_usuario='$id_usuario' and mcn.dia='$dia'";
    $query=$this->db->query($sql);
    return $query->row();

  }

  public function consulta_consecutivo(){

    $query_admin = $this->db->get_where("master_pagina_conf", array("url" => "9450") );

    $consecutivo= $query_admin->row()->parametro;

    return $consecutivo;

  }

  public function   consulta_valorcolombiano(){

    $sql="SELECT parametro from master_pagina_conf where id='18'";
    $query=$this->db->query($sql);
    return $query->row();

  }
  public function   porcentajebitcoin(){

    $sql="SELECT parametro from master_pagina_conf where id='20'";
    $query=$this->db->query($sql);
    return $query->row();

  }
  public function   porcentajenequi(){

    $sql="SELECT parametro from master_pagina_conf where id='25'";
    $query=$this->db->query($sql);
    return $query->row();

  }




public function elimPixel($id){

    $this->db->delete('master_pixeles',array('id'=> $id));


}

public function pixeles($id){

  $sql="SELECT * from master_pixeles where id_usuario='$id'";
  $query=$this->db->query($sql);
  return $query->result();

}



  public function consultaPais(){

    $sql="SELECT * from pais";

    $query=$this->db->query($sql);

    return $query->result();

  }

//cosulta para agragar los datos en Bitcoin
  public function agregar_bitcoin($valor){

    $this->db->insert("master_bitcoin", $valor);
    return $this->db->insert_id();
  //  $data = array(
    //     'url' => $url,
      //   'imagen' => $imagen,
        // 'total' => $total,
        // 'codpedido' => $cod_pedido,
      //   "id_usuario" 	=> $id_usuario,

      //);


      //if($id){
        // $this->db->where('id', $id);
         //$this->db->update('master_bitcoin', $data);
      //}else{
        // $this->db->insert('master_bitcoin', $data);
      //}
    }
    public function agregar_nequi($valor){

      $this->db->insert("master_nequi", $valor);
      return $this->db->insert_id();
    //  $data = array(
      //     'url' => $url,
        //   'imagen' => $imagen,
          // 'total' => $total,
          // 'codpedido' => $cod_pedido,
        //   "id_usuario" 	=> $id_usuario,

        //);


        //if($id){
          // $this->db->where('id', $id);
           //$this->db->update('master_bitcoin', $data);
        //}else{
          // $this->db->insert('master_bitcoin', $data);
        //}
      }

    public function modifiPar($dato,$id){
    $this->db->where('id',$id);
    $this->db->update('master_bitcoin',$dato);
    }

    public function consultar_bitcoin(){

        $sql="SELECT * FROM master_bitcoin";
        $query=$this->db->query($sql);
       return $query->result();


      }

      public function consultar_nequii(){

          $sql="SELECT * FROM master_nequi";
          $query=$this->db->query($sql);
         return $query->result();


        }

    public function validacionbit($datos){



      //Se hace el update a la tabla con los datos enviados
      $this->db->update('master_bitcoin', $datos);

  }
  public function validacionnequii($datos){



    //Se hace el update a la tabla con los datos enviados
    $this->db->update('master_nequi', $datos);

}

  public function inserpago($data_pedido){

    $this->db->insert("master_pagos", $data_pedido);
    return $this->db->insert_id();

  }

  public function usuariospagos(){

    $sql="SELECT nombre, fecha_registro, fecha_pago from master_pagos mp, master_usuarios mu where mu.id = mp.id_usuario and mp.tipo = 'membresia'" ;
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function inserpago1($inserta_pagos1){

    $this->db->insert("master_pagos", $inserta_pagos1);
    return $this->db->insert_id();

  }

  public function inserta_estado1($data_pedido){
    $this->db->insert("estado_pru", $data_pedido);
    return $this->db->insert_id();

  }


  public function inserta_estado($data_pedido){
    $this->db->insert("estado_pru", $data_pedido);
    return $this->db->insert_id();

  }

  public function addPix($dato){
    $this->db->insert("master_pixeles", $dato);
    return $this->db->insert_id();

  }

  public function addCiudadEvento($dato){
    $this->db->insert("master_ciu_evento", $dato);
    return $this->db->insert_id();
  }

  public function elimCiudadEvento($id){
      $this->db->delete('master_ciu_evento',array('id'=> $id));
  }

  public function consCiudadEvento($id){
    $sql="SELECT * from master_ciu_evento where id_usuario='$id'";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function addHoraEvento($value,$id_evento){
    $sql=" insert into master_ciu_hor_evento (hora,id_evento) values ('$value','$id_evento') ";
    $query=$this->db->query($sql);

  }

  public function datos_evento_id ($evento){
      $sql="SELECT id from master_ciu_evento where cod_nombre='$evento'";
      $query=$this->db->query($sql);
      return $query->row()->id;
  }

  public function datos_evento_nombre ($evento){
      $sql="SELECT nombre from master_ciu_evento where cod_nombre='$evento'";
      $query=$this->db->query($sql);
      return $query->row()->nombre;
  }

  public function datos_evento_fecha ($evento){
      $sql="SELECT * FROM master_ciu_evento mce  WHERE cod_nombre='$evento'";
      $query=$this->db->query($sql);
      return $query->result();
  }

  public function datos_evento_horas ($evento){
    $sql="SELECT * from master_ciu_hor_evento where id_evento='$evento'";
    $query=$this->db->query($sql);
    return $query->result();
  }




  public function cant_ventas_rango_classgo($fecha_inicio = NULL,

  $fecha_fin = NULL,

  $idusuario = NULL){

    $sql="SELECT count(*) cant FROM master_pagos

    WHERE id_usuario_papa=$idusuario

    AND fecha_pago >= '$fecha_inicio' AND fecha_pago <='$fecha_fin'

    and tipo='venta'";

    $query=$this->db->query($sql);

    return $query->row()->cant;

  }



  public function con_parametros($id_parametro){

    $sql="SELECT parametro FROM master_pagina_conf where id=$id_parametro;";

    $query=$this->db->query($sql);

    return $query->row()->parametro;

  }
  public function consultar_nequi(){

    $sql="SELECT nequi FROM master_pagina_conf where id='25'";

    $query=$this->db->query($sql);

    return $query->row();

  }


  public function diasMemb(){

    $sql="SELECT parametro FROM master_pagina_conf where id='8'";

    $query=$this->db->query($sql);

    return $query->row()->parametro;

  }


  public function consultPedi($dato){

    $sql="SELECT * FROM master_pagos_pedidos where cod_pedido='$dato'";
    $query=$this->db->query($sql);
    return $query->row();

  }




  public function inserta_pedido($data_pedido){

    $this->db->insert("master_pedido", $data_pedido);

    return $this->db->insert_id();

  }

public function consultar_pago(){

  $sql = "SELECT url,imagen,total,codpedido, id_usuario,id_usuario_papa from master_bitcoin";
  $query=$this->db->query($sql);
  return $query->result();

}

  public function inserta_pago_pedido($data_pedido){

    $this->db->insert("master_pagos_pedidos", $data_pedido);

    return $this->db->insert_id();

  }


  public function inserta_pago_pedido1($id){

    $sql = "SELECT parametro from master_pagina_conf where id=17";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }
  public function inserta_pago_pedido2($id){

    $sql = "SELECT parametro from master_pagina_conf where id=19 ";


    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }
  public function valor_producto($id){

    $sql = "SELECT valor FROM master_producto WHERE id_producto=15 ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }
  public function parametro_bitcoinn($id){

    $sql =  "SELECT parametro from master_pagina_conf where id=20 ";

    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }
  public function inserta_pago_pedido3($id){

    $sql = "SELECT parametro from master_pagina_conf where id=18 ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  /* inserta_pago_pedido3 => obtener valortrm de negocios */
  public function obtenerValorTrm($id){

    $sql = "SELECT valor from master_negocios_parametros where id=$id ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  public function inserta_pago_pedido4($id){

    $sql = "SELECT parametro from master_pagina_conf where id=20 ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }
  public function convendedor($id){

    $sql = "select * from master_usuarios where id=$id";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }



  public function precioProducto($id){

    $sql = "SELECT valor from master_producto where id_producto='$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row()->valor;

  }

  /* precioProducto => para negocios */
  public function precioNegocio($id){

    $sql = "SELECT valor from master_negocios_parametros where id_negocios=$id";

    $query_admin = $this->db->query($sql);

    return $query_admin->row()->valor;

  }


  public function conProducto($id){

    $sql = "SELECT * from master_producto where id_producto=15 ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  public function conProductoConsul($id){

    $sql = "SELECT * from master_producto where id_producto=$id ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  

  public function consultarProducto($id){

    $sql = "SELECT * from master_producto where id_producto=$id ";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  /* conProducto => para negocios */

  public function conNegocio($id){

    $sql = "SELECT * FROM master_negocios_parametros mnp 
    INNER JOIN master_negocios mn ON mnp.id_negocios = mn.id_negocio WHERE id_negocios = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  public function id_negocio_user($user){

    $sql = "SELECT *
              FROM master_usuario_negocio mun ,
              master_usuarios mu
                where mu.id = mun.id_usuario
                and mu.user='$user' ;";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }


  public function conNegocio_user($user){

    $sql = "select  mnp.* 
              from master_usuario_negocio mun, 
              master_usuarios mu,
              master_negocios_parametros mnp
              where  mu.id = mun.id_usuario 
                and mun.id_usuario = mu.id  
                and mnp.id_negocios = mun.id_negocio  
                and mu.user = '$user';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  public function con_papa_user($user){

    $sql = "select * from master_usuarios mu  
    where mu.user = '$user';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }



  public function conNegocio_user_paquete($user,$paquete){

    $sql = "select  mnp.* 
            from master_usuario_negocio mun, 
            master_usuarios mu,
            master_negocios_parametros mnp
            where  mu.id = mun.id_usuario 
              and mun.id_usuario = mu.id  
              and mnp.id_negocios = mun.id_negocio  
              and mu.user = '$user'
            and mnp.descripcion ='$paquete';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }


  public function consulta_papa_user($id_user){

    $sql = "select id_papa_pago from master_usuarios mu  where id='$id_user' ";
    
    $query_admin = $this->db->query($sql);
    return $query_admin->row();
  }

  public function conNegocio_parametros_id($id){

    $sql = "select  mnp.* 
              from master_usuario_negocio mun, 
              master_usuarios mu,
              master_negocios_parametros mnp
              where  mu.id = mun.id_usuario 
                and mun.id_usuario = mu.id  
                and mnp.id_negocios = mun.id_negocio  
                and mu.id = '$id';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();
  }

  public function bonodeInicioRapido($id){

    $sql = "select * from master_tiindo_bir mtb2 WHERE estado ='ACTIVO' order by generacion DESC ;";
    $query_admin = $this->db->query($sql);
    return $query_admin->row();
  }


  public function conNegocio_parametros_id_descri($id, $descri){

    $sql = "select  mnp.* 
              from master_usuario_negocio mun, 
              master_usuarios mu,
              master_negocios_parametros mnp
              where  mu.id = mun.id_usuario 
                and mun.id_usuario = mu.id  
                and mnp.id_negocios = mun.id_negocio  
                and mu.id = '$id'
                and mnp.descripcion ='$descri';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }


  public function conNegocio_user_valor($user){

    $sql = "select  mnp.*,mn.nombre_negocio 
              from master_usuario_negocio mun, 
              master_usuarios mu,
              master_negocios_parametros mnp,
              master_negocios mn
              where  mu.id = mun.id_usuario 
                and mun.id_usuario = mu.id  
                and mnp.id_negocios = mun.id_negocio  
                and mnp.id_negocios = mn.id_negocio 
                and mu.user = '$user'
              and descripcion='paquete1';";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }


  /* función para consultar los parametros de Landing Libertad => para negocios */

  public function conParametrosLandingLibertad($id){

    $sql = "SELECT * from master_parametros_landing_registro_libertad mplrl where mplrl.id_usuario = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  
  public function actualiza_datos_clientes($datos, $id){

    $this->db->where('id',$id);
    $this->db->update('master_usuarios',$datos);

  }

  
  public function inserta_datos_clientes($datos){

    $this->db->insert('master_usuarios',$datos);

  }

  /* función para consultar los parametros de Landing Libertad => para negocios */

  public function conParametrosWebinarLibertad($id){

    $sql = "SELECT * from master_parametros_webinar_registro_libertad where id_usuario = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  /* función para editar los parametros de webinar Libertad => para negocios */

  public function editarParametrosWebinarLibertad($datos, $id){

    $this->db->where('id_usuario',$id);
    $this->db->update('master_parametros_webinar_registro_libertad',$datos);

  }

  /* función para editar los parametros de Landing Libertad => para negocios */

  public function editarParametrosLandingLibertad($datos, $id){

    $this->db->where('id_usuario',$id);
    $this->db->update('master_parametros_landing_registro_libertad',$datos);

  }

  /* función para editar la imagen del webinar */

  public function actualiza_img_webinar($dato, $id){
    $this->db->where('id_usuario', $id);
    $this->db->update('master_parametros_webinar_registro_libertad', $dato);
  }

  /* función para editar la imagen de la landing libertad */

  public function actualiza_img_landing($dato, $id){
    $this->db->where('id_usuario', $id);
    $this->db->update('master_parametros_landing_registro_libertad', $dato);
  }

  /* función para editar la imagen de la landing gracias libertad */

  public function actualiza_img_landing_gracias($dato, $id){
    $this->db->where('id_usuario', $id);
    $this->db->update('master_parametros_landing_gracias_libertad', $dato);
  }

  /* función para consultar los parametros de Landing gracias Libertad => para negocios */

  public function conParametrosLandingGraciasLibertad($id){

    $sql = "SELECT * from master_parametros_landing_gracias_libertad where id_usuario = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }
  public function landingRtaLibertad($id){

    $sql = "SELECT * from master_parametros_landing_registro_libertad where id_usuario = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }


  
  public function consulta_testi($id){

    $sql = "SELECT * from master_testimonios where id_usuario = '$id'";
    $query_admin = $this->db->query($sql);
    return $query_admin->result();

  }

  public function consulta_testi_videos($id){

    $sql = "SELECT * from master_testimonio_video where id_usuario = '$id'";
    $query_admin = $this->db->query($sql);
    return $query_admin->result();

  }

  public function consulta_productos($id){

    $sql = "SELECT * from master_producto where id_usuario = '$id'";
    $query_admin = $this->db->query($sql);
    return $query_admin->result();

  }

  public function consulta_usuario($id){

    $sql = "SELECT * from master_usuarios where id = '$id'";
    $query_admin = $this->db->query($sql);
    return $query_admin->row();

  }


  /* función para consultar los parametros de Landing gracias Libertad => para negocios */

  public function conParametrosWebinarGraciasLibertad($id){

    $sql = "SELECT * from master_parametros_webinar_gracias_libertad where id_usuario = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  /* consultar datos del administrador del negocio */
  public function conAdministradorNegocio($id){

    $sql = "SELECT * from master_negocios_administradores where id_negocio = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row()->id_usuario;

  }


  /* función para editar los parametros de webinar gracias Libertad => para negocios */

  public function editarParametrosWebinarGraciasLibertad($datos, $id){

    $this->db->where('id_usuario',$id);
    $this->db->update('master_parametros_webinar_gracias_libertad',$datos);

  }

  /* función para editar los parametros de landing gracias Libertad => para negocios */

  public function editarParametrosLandingGraciasLibertad($datos, $id){

    $this->db->where('id_usuario',$id);
    $this->db->update('master_parametros_landing_gracias_libertad',$datos);

  }

  /* función para contar la cantidad de registrados en la landing para un usuario especifico*/

  public function cantidadRegistradosLanding($id){
    /* el id = 7 de la consulta es para el negocio de multinivel libertad latam */
    $sql = "SELECT COUNT(id_usuario) as registrados FROM master_registro_usuario WHERE id_landing = 7 AND id_papa = '$id'";

    $query_admin = $this->db->query($sql);

    return $query_admin->row()->registrados;

  }

  public function conProductopayu($id){


    //$sql = "SELECT (mp.parametro + mpc.parametro) as parametrop FROM master_pagina_conf mp, master_pagina_conf mpc

    //where mp.id=15
     //and mpc.id=15";
     $sql = "SELECT * from master_producto where id_producto=15  ";
    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }

  public function conProductoBit($id){


    //$sql = "SELECT (mp.parametro + mpc.parametro) as parametrop FROM master_pagina_conf mp, master_pagina_conf mpc

    //where mp.id=15
     //and mpc.id=15";
     $sql = "SELECT * from master_producto where id_producto=429  ";
    $query_admin = $this->db->query($sql);

    return $query_admin->row();

  }

  public function inserperiodoclassgo($inserta_datos_classgo){

    $this->db->insert("master_pagos_periodo_classgo", $inserta_datos_classgo);

    return $this->db->insert_id();

  }

  public function inserta_cliente_pedido($data_cliente){

    $this->db->insert("master_usuarios", $data_cliente);

    return $this->db->insert_id();



  }



  public function consult_pedido($id_producto,$email_user){

    $sql = "select * from master_pedido";

    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }



  public function con_pedido($cod_pedido=NULL,$id_pedido=NULL){

    $sql = "SELECT * FROM master_pedido WHERE cod_pedido='".$cod_pedido."' AND id_usuario='".$id_pedido."';";

    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }



  public function averigua_dueno_producto($id_producto){



    #calcula valor de la promocion

    $sql = "SELECT id_usuario

    FROM master_producto

    WHERE id_producto=".$id_producto.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $id_usuario= $query_admin->row()->id_usuario;



    ##}

    return $id_usuario;

  }



  public function cmoneda($idproducto){



    #calcula valor de la promocion

    $sql = "SELECT moneda FROM  master_producto  WHERE id_producto=".$idproducto.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $moneda= $query_admin->row()->moneda;



    ##}

    return $moneda;

  }



  public function porcentajeV($idproducto){



    #calcula valor de la promocion

    $sql = "SELECT porcentaje_vendedor FROM  master_producto  WHERE id_producto=".$idproducto.";";



    $query_admin = $this->db->query($sql);

    $porcentaje= $query_admin->row()->porcentaje_vendedor;





    return $porcentaje;

  }



  public function consultaVendedor($idusuario){



    #calcula valor de la promocion

    $sql = "SELECT id_vendedor FROM master_nacional WHERE id=".$idusuario.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $id_vendedor= $query_admin->row()->id_vendedor;



    ##}

    return $id_vendedor;

  }





  public function consultaFechacorte($fecha){



    #calcula valor de la promocion

    $sql = "SELECT mcp.fin_corte, DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +14 DAY),'%Y-%m-%d') AS fecha_pago

    FROM master_corte_pagos mcp

    WHERE DATE_FORMAT('".$fecha."','%Y-%m-%d')

    BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY)

    AND mcp.fin_corte;";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $fecha_corte= $query_admin->row()->fin_corte;

    $fecha_pago= $query_admin->row()->fecha_pago;



    ##}

    return $fecha_corte;

  }



  public function consultaFechapago($fecha){

    #calcula valor de la promocion

    $sql = "SELECT mcp.fin_corte, DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +14 DAY),'%Y-%m-%d') AS fecha_pago

    FROM master_corte_pagos mcp

    WHERE DATE_FORMAT('".$fecha."','%Y-%m-%d')

    BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY)

    AND mcp.fin_corte;";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $fecha_corte= $query_admin->row()->fin_corte;

    $fecha_pago= $query_admin->row()->fecha_pago;



    ##}

    return $fecha_pago;

  }



  public function consul_cuenta_payU($var){

    $query_usuario = $this->db->get_where("master_config_payu", array("id" => 1) );

    if ($var=='accountId' || $var=='merchantId' || $var='ApiKey'){

      return $query_usuario->row()->$var;

    }

  }


  public function consul_cuenta_paypal($var){
    $query_usuario = $this->db->get_where("master_usuarios", array("id" => 5) );
    if ($var=='cuenta_paypal'){
      return $query_usuario->row()->$var;
    }
  }

  
  public function consulta_user_papa($idusuario){
   
    $sql = "SELECT user FROM master_usuarios WHERE id=$idusuario ";

    $query_admin = $this->db->query($sql);
    return $query_admin->row()->user;

  }

  
  public function consul_cuenta_paypal_cliente($idusuario){
   
    $sql = "SELECT cuenta_paypal FROM master_usuarios WHERE id=$idusuario ";

    $query_admin = $this->db->query($sql);
    return $query_admin->row()->cuenta_paypal;

  }

  public function consul_cuenta_bitcoin($var){
    $query_usuario = $this->db->get_where("master_config_bitcoin");
    if ($var=='cuenta_bitcoin'){
      return $query_usuario->row()->$var;
    }

  }




  public function ventas_semanales(){

    $id_login = $this->session->userdata('ID');

    #calcula valor de la promocion

    $sql = "SELECT DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY),'%Y-%m-%d') AS inicio,

    DATE_FORMAT(mcp.fin_corte,'%Y-%m-%d') AS fin,

    round(SUM(mc.cantidad),0)AS ganancia, mcp.semana,mc.estado,

    DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +7 DAY),'%Y-%m-%d') AS pago, mc.id_usuario,mu.nombre AS nombre ,mu.apellido1 AS apellido,

    mu.numero_cuenta, mu.tipo_cuenta,mu.cedula, mu.banco

    FROM master_comisiones mc, master_corte_pagos mcp, master_usuarios mu

    WHERE mc.fecha_comision BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY) AND DATE_ADD(mcp.fin_corte, INTERVAL +1 DAY)

    AND mc.estado=1

    AND mc.id_usuario= mu.id

    GROUP BY mc.id_usuario ORDER BY mcp.semana DESC;";

    $query_admin = $this->db->query($sql);



    return $query_admin->result();

  }





  public function addAccountbank($name,$identification,$banco,$tipeacc,$numacc,$acc){

    $usuario=$this->session->userdata('USUARIO');

    $this->db->where('correo',$usuario);

    $this->db->update('master_usuarios',array('nombre'=>$name,'cedula'=>$identification, 'banco'=>$banco, 'tipo_cuenta'=>$tipeacc, 'numero_cuenta'=>$numacc));

    $paypal=$this->session->userdata('ID');

    $this->db->where('id_usuario',$paypal);

    $this->db->update('master_config_paypal',array('cuenta_paypal'=>$acc));

  }



  public function addAccountpaypal($data){

    $this->db->insert('master_config_paypal', $data);

  }

  public function updateAccountpaypal($data){





    $Idusuario=$this->session->userdata('ID');

    $this->db->where(array("id_usuario" => $Idusuario))->update("master_config_paypal", $data);

  }



  public function consultapaypal(){

    $Idusuario=$this->session->userdata('ID');

    $sql="select count(*) as cant from master_config_paypal where id_usuario='$Idusuario' ";

    $query = $this->db->query($sql);

    return  $query->row()->cant;



  }



  public function infoBank(){

    $usuario=$this->session->userdata('USUARIO');

    $sql="SELECT * from master_usuarios u where u.correo='$usuario'";

    $query=$this->db->query($sql);

    return $query->row();

  }



  public function listaBanco(){

    $sql="SELECT * from master_bancos order by banco";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function listaTypB(){

    $sql="SELECT * from master_bancos_tipoacc order by tipo_cuenta";

    $query=$this->db->query($sql);

    return $query->result();



  }

  public function listaPaypal(){

    $usuario=$this->session->userdata('ID');

    $sql="SELECT cuenta_paypal from master_config_paypal where id_usuario='$usuario'";

    $query=$this->db->query($sql);

    return $query->row();

  }

  public function consultTransfer(){



    $sql="SELECT mu.nombre, mu.apellido1, mpc.url, mpc.parametro, mpc.descri, met.estado, mbt.tipo_cuenta, mb.banco, mt.*

    from master_transferencia mt, master_usuarios mu, master_pagina_conf mpc, master_estados_transfer met, master_bancos_tipoacc mbt, master_bancos mb

    WHERE mt.id_usuario=mu.id

    AND mt.id_cobro_tipo_tranfer=mpc.id

    AND mt.id_estado=met.id

    AND mt.id_tipo_cuenta=mbt.id

    AND mt.id_banco_entidad=mb.id

    ORDER BY mt.fecha_pago DESC;";

    $query=$this->db->query($sql);

    return $query->result();

  }


  public function modEstadoTrans($id)
  {
    $this->db->where('id',$id);
    $this->db->update('master_transferencia',array('id_estado'=>2));
  }

  public function tipo_cuenta()
  {
    $resultado = $this->db->get("master_data_tipo_cuenta");
    return $resultado->result();
  }
  public function bancos()
  {
    $resultado = $this->db->get("master_data_banco");
    return $resultado->result();
  }


}

?>
