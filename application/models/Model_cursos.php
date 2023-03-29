<?php

defined('BASEPATH') or exit('No direct script access allowed');

class model_cursos extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Consultar

    public function cargar()
    {
        $this->db->order_by('fecha_creacion', 'DESC');
        $resultado = $this->db->get('cursos');

        return $resultado->result();
    }

    public function cargarxid($id)
    {
        $this->db->order_by('fecha_creacion', 'DESC');
        $this->db->where('categoria',$id);
        $resultado = $this->db->get('cursos');

        return $resultado->result();
    }

    public function cargar_membresia()
    {
        $resultado = $this->db->get('curso_membresia');

        return $resultado->result();
    }

    public function consultar_membresia()
    {
        $id = $this->session->userdata('ID');

        $this->db->where('activo',1);
        $this->db->where('usuario_id', $id);
        $resultado = $this->db->get('membresia_adquision_curso');

        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return false;
        }
    }

    public function cargar_membresia_id($id)
    {
        $this->db->where('id',$id);
        $resultado = $this->db->get('curso_membresia');

        return $resultado->row();
    }

    public function cargar_categoria()
    {
        $resultado = $this->db->get('curso_categoria');

        return $resultado->result();
    }

    public function cargar_categoria_grupo()
    {
        $sql = "SELECT * FROM curso_categoria WHERE id IN (SELECT categoria FROM cursos)";

        $resultado = $this->db->query($sql);

        return $resultado->result();
    }

    public function cargar_cursos_duenos()
    {
        $id = $this->session->userdata('ID');

        $this->db->where('creador',$id);
        $this->db->select('c.*, ca.categoria as categorias');
        $this->db->from('cursos c');
        $this->db->join('curso_categoria ca','c.categoria = ca.id');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function cargar_curso_id($id)
    {
        $this->db->where('id',$id);
        $resultado = $this->db->get('cursos');

        return $resultado->row();
    }

    public function cargar_curso_seccion_id($id)
    {
        $this->db->where('cursos_id',$id);
        $resultado = $this->db->get('curso_seccion');

        return $resultado->result();
    }

    // insertar

    public function insertar_membresia($data)
    {
        $this->db->insert('membresia_adquision_curso',$data);
    }

    public function insertar_cursos($data)
    {
        $this->db->insert('cursos',$data);
    }

    // eliminar

    public function deleteCurso($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('cursos');
    }

    public function delete_detalle_curso($id)
    {
        $this->db->where('curso_id',$id);
        $this->db->delete('curso_seccion');
    }
}
