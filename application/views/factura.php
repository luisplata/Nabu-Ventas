<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->load->view("factura/head");
$this->load->view("factura/menu");
$this->load->view("factura/mensaje");
$this->load->view("factura/" . $izq);
$this->load->view("factura/" . $der);
$this->load->view("factura/foot");
