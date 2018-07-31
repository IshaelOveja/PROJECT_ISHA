-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2018 a las 10:08:48
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Base de datos: `cordelima`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fc_correlativo` (`p_tabla` VARCHAR(50), `p_param1` VARCHAR(50), `p_param2` VARCHAR(50)) RETURNS VARCHAR(15) CHARSET latin1 BEGIN

        declare l_contador integer;
        declare l_id varchar(50);

        set l_contador=0;
        set l_id=null;

        if (p_tabla='gen_personas') then

	        select  COALESCE(max(cast(cc_empleado as UNSIGNED)),0)+1  into l_contador
                from gen_personas;

			if l_contador is null then
					set l_contador:=1;
      end if;

		set l_id= LPAD(CAST(l_contador as CHAR),8,'0');
		
        elseif  (p_tabla='seg_usuario') then

               select  COALESCE(max(cc_usuario),0)+1  into l_contador
                from seg_usuario;

               if l_contador is null then

			set l_contador:=1;

		end if;


                set l_id=CAST(l_contador as CHAR);



        elseif (p_tabla='seg_perfil') then

                select  COALESCE(max(cc_perfil),0)+1  into l_contador
                from seg_perfil;

               if l_contador is null then

			set l_contador:=1;

		end if;

		
		set l_id= LPAD(CAST(l_contador as CHAR),8,'0');
				
       ELSEif (p_tabla='eve_cursos') then

	        select  COALESCE(max(cast(cc_cursos as UNSIGNED)),0)+1  into l_contador
                from eve_cursos;

			if l_contador is null then
					set l_contador:=1;
      end if;

		set l_id= LPAD(CAST(l_contador as CHAR),8,'0');
		
       
	ELSEif (p_tabla='eve_cobros') then

                select  COALESCE(max(cc_cobros),0)+1  into l_contador
                from eve_cobros;
              
				  if l_contador is null then

			set l_contador:=1;

		end if;

	set l_id= LPAD(CAST(l_contador as CHAR),8,'0');
		
    ELSEif (p_tabla='eve_control') then

                select  COALESCE(max(cc_control),0)+1  into l_contador
                from eve_control;
              
				  if l_contador is null then

			set l_contador:=1;

		end if;

	set l_id= LPAD(CAST(l_contador as CHAR),8,'0');

		ELSEif (p_tabla='eve_lugar') then

                select  COALESCE(max(cc_lugar),0)+1  into l_contador
                from eve_lugar;
                

               if l_contador is null then

			set l_contador:=1;

		end if;
		
		set l_id= LPAD(CAST(l_contador as CHAR),8,'0');

		ELSEif (p_tabla='eve_cursos_taller') then

                select  COALESCE(max(cc_taller),0)+1  into l_contador
                from eve_cursos_taller;
                

               if l_contador is null then

			set l_contador:=1;

		end if;

	
	
		
       end if;

        return l_id;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fc_crea_modulo_perfil` (`p_cc_modulo` INTEGER, `p_cc_perfil` INTEGER, `p_cc_usuario` INTEGER, `p_ct_ip` VARCHAR(20)) RETURNS INT(11) BEGIN
declare l_mod_padre integer;
declare l_mod_padre1 integer;
declare l_mod_nivel integer;
declare l_mod_id integer;
declare l_contador integer;

set l_mod_padre =0;
set l_mod_padre1 =0;
set l_mod_id =0;
set l_contador =0;

select  cc_padre,nn_nivel,cc_modulo
into l_mod_padre,l_mod_nivel,l_mod_id
from seg_modulo  where cc_modulo=p_cc_modulo;

SELECT  count(cc_modulo)
INTO l_contador
FROM seg_modulo_perfil
where cc_modulo=l_mod_id
and cc_perfil=p_cc_perfil;

if l_contador = 0 then
        insert into seg_modulo_perfil(
                cc_modulo,
                cc_perfil,
                cc_usuario_audit,
                df_log,
                ct_ip
               ) values(
               l_mod_id,
               p_cc_perfil,
               p_cc_usuario,
               current_timestamp,
               p_ct_ip
               );
end if;

if l_mod_nivel = 1 then
        SELECT  count(cc_modulo)
        INTO l_contador
        FROM seg_modulo_perfil
        where cc_modulo=l_mod_padre
        and cc_perfil=p_cc_perfil;

        if l_contador = 0 then
                insert into seg_modulo_perfil(
                        cc_modulo,
                        cc_perfil,
                        cc_usuario_audit,
                        df_log,
                        ct_ip
               ) values(
                       l_mod_padre,
                       p_cc_perfil,
                       p_cc_usuario,
                       current_timestamp,
                       p_ct_ip
               );


        end if;
end if;

return l_mod_padre;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fc_modulo_opcion` (`p_cc_modulo` INT) RETURNS VARCHAR(50) CHARSET latin1 BEGIN
     declare l_ct_ruta varchar(200);
     declare l_mod_nombre_padre varchar(60);
     declare l_mod_nombre_hijo varchar(60);
     declare l_mod_nombre varchar(60);
     declare l_mod_id1 varchar(10);
     declare l_mod_id2 varchar(10);
     declare l_mod_id3 varchar(10);

     set l_ct_ruta='';

     if p_cc_modulo is not null then

             select mod_id1, mod_id2, mod_id3, mod_nombre into l_mod_id1, l_mod_id2, l_mod_id3, l_mod_nombre_padre
             from seg_modulo where mod_id1= SUBSTR(p_cc_modulo,1,2) and mod_id2='00' and mod_id3='00';
             
             select  mod_id1, mod_id2,mod_nombre into l_mod_id1, l_mod_id2, l_mod_nombre_hijo
             from seg_modulo where concat(mod_id1,'',mod_id2)= SUBSTR(p_cc_modulo,1,4) and mod_id3='00';

             select mod_nombre into l_mod_nombre
             from seg_modulo where concat(mod_id1,'',mod_id2,'',mod_id3)= p_cc_modulo;

             if l_mod_nombre_padre is not null and l_mod_nombre_hijo is not null  then
                     set  l_ct_ruta = concat(l_mod_nombre_padre,' >> ', l_mod_nombre_hijo,' >> ',l_mod_nombre);
             end if;
     end if;

     if l_ct_ruta is null then
             set  l_ct_ruta='';
     end if;

     return l_ct_ruta;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fc_parametro_valor` (`p_cc_tabla` VARCHAR(50), `p_cc_campo` VARCHAR(50), `p_cc_codigo` VARCHAR(10)) RETURNS VARCHAR(200) CHARSET latin1 BEGIN

        declare l_i integer ;

        declare l_pde_vals varchar(200);

         set l_pde_vals='' ;

         SELECT  count(*) into  l_i
            FROM gen_parametro p,
            gen_parametro_det pd,
            gen_parametro_tabla pt
            WHERE p.cc_parametro=pd.cc_parametro
            AND p.cc_parametro=pt.cc_parametro
            AND pd.cc_parametro=pt.cc_parametro
            AND pt.cc_tabla=p_cc_tabla
            AND pt.cc_campo=p_cc_campo
            AND pd.cc_codigo= p_cc_codigo;

         if l_i=1 then
                 SELECT  pd.ct_par_det_corto into  l_pde_vals
                    FROM gen_parametro p,
                    gen_parametro_det pd,
                    gen_parametro_tabla pt
                    WHERE p.cc_parametro=pd.cc_parametro
                    AND p.cc_parametro=pt.cc_parametro
                    AND pd.cc_parametro=pt.cc_parametro
                    AND pt.cc_tabla=p_cc_tabla
                    AND pt.cc_campo=p_cc_campo
                    AND pd.cc_codigo= p_cc_codigo;
         end if;

	if l_pde_vals is null then

                set l_pde_vals='';

	end if;



	return l_pde_vals;


END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fc_ruta` (`p_cc_modulo` INT) RETURNS VARCHAR(100) CHARSET latin1 BEGIN
     declare l_ct_ruta varchar(200);
     declare l_mod_nombre_padre varchar(60);
     declare l_mod_nombre_hijo varchar(60);
     declare l_mod_nombre varchar(60);
     declare l_mod_id1 varchar(10);
     declare l_mod_id2 varchar(10);
     declare l_mod_id3 varchar(10);

     set l_ct_ruta='';

     if p_cc_modulo is not null then

             select mod_id1, mod_id2, mod_id3, mod_nombre into l_mod_id1, l_mod_id2, l_mod_id3, l_mod_nombre_padre
             from seg_modulo where mod_id1= SUBSTR(p_cc_modulo,1,2) and mod_id2='00' and mod_id3='00';
             
             select  mod_id1, mod_id2,mod_nombre into l_mod_id1, l_mod_id2, l_mod_nombre_hijo
             from seg_modulo where concat(mod_id1,'',mod_id2)= SUBSTR(p_cc_modulo,1,4) and mod_id3='00';

             select mod_nombre into l_mod_nombre
             from seg_modulo where concat(mod_id1,'',mod_id2,'',mod_id3)= p_cc_modulo;

             if l_mod_nombre_padre is not null and l_mod_nombre_hijo is not null  then
                     set  l_ct_ruta = concat('Inicio >> ',l_mod_nombre_padre,' >> ', l_mod_nombre_hijo,' >> ',l_mod_nombre);
             end if;
     end if;

     if l_ct_ruta is null then
             set  l_ct_ruta='';
     end if;

     return l_ct_ruta;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_caja`
--

CREATE TABLE `fin_caja` (
  `cc_caja` int(10) NOT NULL,
  `caj_ano` varchar(4) NOT NULL DEFAULT '',
  `caj_fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `reg_fecha` date DEFAULT NULL,
  `cc_persona` int(6) NOT NULL,
  `pag_tipo` varchar(2) NOT NULL,
  `ct_tipo` varchar(2) NOT NULL,
  `ct_serie` varchar(4) NOT NULL,
  `ct_numero` int(8) UNSIGNED ZEROFILL NOT NULL,
  `ct_vigencia` varchar(2) DEFAULT '',
  `caj_obs` varchar(250) DEFAULT NULL,
  `cc_usuario` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_caja`
--

INSERT INTO `fin_caja` (`cc_caja`, `caj_ano`, `caj_fecha`, `reg_fecha`, `cc_persona`, `pag_tipo`, `ct_tipo`, `ct_serie`, `ct_numero`, `ct_vigencia`, `caj_obs`, `cc_usuario`) VALUES
(817911, '2017', '2017-11-22 17:53:04', '2017-11-22', 9, 'E', 'NC', '001', 00000888, '1', '', '000001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_caja_detalle`
--

CREATE TABLE `fin_caja_detalle` (
  `cc_caja_det` int(10) UNSIGNED NOT NULL,
  `cc_caja` int(10) NOT NULL,
  `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_cantidad` int(11) DEFAULT '0',
  `ct_importe` decimal(10,2) DEFAULT '0.00',
  `ct_total` decimal(10,2) DEFAULT '0.00',
  `ct_igv` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_caja_detalle`
--

INSERT INTO `fin_caja_detalle` (`cc_caja_det`, `cc_caja`, `cc_articulo`, `ct_cantidad`, `ct_importe`, `ct_total`, `ct_igv`) VALUES
(1, 817911, 000083, 8, '135.00', '1080.00', '0.18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_caja_detalle_temp`
--

CREATE TABLE `fin_caja_detalle_temp` (
  `cc_caja_det` int(3) UNSIGNED NOT NULL,
  `cc_codigo` varchar(50) NOT NULL DEFAULT '0',
  `cc_articulo` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ct_cantidad` int(11) DEFAULT '0',
  `ct_importe` decimal(10,2) DEFAULT '0.00',
  `ct_total` decimal(10,2) DEFAULT '0.00',
  `ct_igv` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_compras`
--

CREATE TABLE `fin_compras` (
  `cc_compras` int(10) NOT NULL,
  `ct_ano` varchar(4) DEFAULT NULL,
  `ct_fecha` date DEFAULT NULL,
  `emp_id` varchar(15) DEFAULT NULL,
  `ct_comprobante` varchar(6) DEFAULT NULL,
  `ct_serie` varchar(4) DEFAULT NULL,
  `ct_numero` varchar(10) DEFAULT NULL,
  `cc_usuario` varchar(6) DEFAULT NULL,
  `ct_fecha_doc` date DEFAULT NULL,
  `ct_vigencia` varchar(2) DEFAULT NULL,
  `ct_total` decimal(10,2) DEFAULT NULL,
  `ct_obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_compras`
--

INSERT INTO `fin_compras` (`cc_compras`, `ct_ano`, `ct_fecha`, `emp_id`, `ct_comprobante`, `ct_serie`, `ct_numero`, `cc_usuario`, `ct_fecha_doc`, `ct_vigencia`, `ct_total`, `ct_obs`) VALUES
(2017072550, '2017', '2017-11-15', '000014', 'FC', '001', '11777', '000001', '2017-10-20', '1', '4402.45', ''),
(2017135635, '2017', '2017-11-20', '000020', 'FC', '001', '9', '000001', '2017-10-20', '1', '306.80', ''),
(2017195355, '2017', '2017-11-15', '000002', 'FC', '001', '10883', '000001', '2017-10-31', '1', '8755.98', ''),
(2017326644, '2017', '2017-11-15', '000016', 'BO', '001', '888999', '000001', '2017-10-19', '1', '707.23', ''),
(2017667783, '2017', '2017-11-15', '000002', 'FC', '001', '10441', '000001', '2017-09-30', '1', '587.78', ''),
(2017678359, '2017', '2017-11-15', '000002', 'FC', '001', '10504', '000001', '2017-09-30', '1', '1990.61', ''),
(2017689575, '2017', '2017-11-20', '000013', 'FC', '001', '13402', '000001', '2017-11-16', '1', '28433.28', ''),
(2017760377, '2017', '2017-11-15', '000017', 'FC', '001', '4383', '000001', '2017-10-27', '1', '4327.13', ''),
(2017909777, '2017', '2017-11-15', '000002', 'FC', '001', '10766', '000001', NULL, '1', '379.49', ''),
(2017977376, '2017', '2017-11-15', '000017', 'FC', '001', '4414', '000001', '2017-10-31', '1', '437.97', ''),
(2017981394, '2017', '2017-11-15', '000002', '', '001', '10825', '000001', '2017-10-31', '1', '1266.19', ''),
(2017995516, '2017', '2017-11-15', '000014', 'FC', '001', '12082', '000001', '2017-11-08', '1', '1051.24', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_compras_detalle`
--

CREATE TABLE `fin_compras_detalle` (
  `cc_compras_det` int(10) UNSIGNED NOT NULL,
  `cc_compras` int(10) NOT NULL,
  `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_cantidad` int(11) DEFAULT '0',
  `ct_importe` decimal(10,2) DEFAULT '0.00',
  `ct_total` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_compras_detalle`
--

INSERT INTO `fin_compras_detalle` (`cc_compras_det`, `cc_compras`, `cc_articulo`, `ct_cantidad`, `ct_importe`, `ct_total`) VALUES
(1, 2017326644, 000146, 4, '32.20', '128.80'),
(2, 2017326644, 000147, 5, '16.95', '84.75'),
(3, 2017326644, 000121, 20, '4.24', '84.80'),
(4, 2017326644, 000122, 20, '4.24', '84.80'),
(5, 2017326644, 000123, 20, '4.24', '84.80'),
(6, 2017326644, 000148, 20, '1.69', '33.88'),
(7, 2017326644, 000149, 20, '4.24', '84.80'),
(8, 2017326644, 000124, 3, '4.24', '12.72'),
(9, 2017667783, 000151, 12, '41.51', '498.12'),
(10, 2017678359, 000074, 72, '23.43', '1686.96'),
(11, 2017072550, 000152, 12, '58.98', '707.76'),
(12, 2017072550, 000154, 12, '22.69', '272.28'),
(13, 2017072550, 000027, 12, '60.77', '729.24'),
(14, 2017072550, 000155, 31, '26.93', '834.83'),
(15, 2017072550, 000153, 1, '0.10', '0.10'),
(16, 2017072550, 000057, 12, '32.89', '394.68'),
(17, 2017072550, 000054, 24, '33.00', '792.00'),
(35, 2017977376, 000158, 3, '123.72', '371.16'),
(36, 2017909777, 000161, 12, '26.80', '321.60'),
(37, 2017981394, 000162, 12, '89.42', '1073.04'),
(38, 2017195355, 000163, 48, '17.49', '839.52'),
(39, 2017195355, 000014, 240, '27.42', '6580.80'),
(40, 2017995516, 000153, 24, '37.12', '890.88'),
(41, 2017760377, 000159, 12, '47.46', '569.52'),
(42, 2017760377, 000160, 10, '42.37', '423.70'),
(43, 2017760377, 000158, 1, '122.88', '122.88'),
(44, 2017760377, 000087, 16, '25.42', '406.72'),
(45, 2017760377, 000086, 12, '78.81', '945.72'),
(46, 2017760377, 000156, 10, '26.30', '263.00'),
(47, 2017760377, 000157, 12, '42.37', '508.44'),
(48, 2017760377, 000104, 12, '35.59', '427.08'),
(49, 2017689575, 000120, 60, '76.70', '4602.00'),
(50, 2017689575, 000115, 60, '60.50', '3630.00'),
(51, 2017689575, 000114, 60, '41.00', '2460.00'),
(52, 2017689575, 000118, 20, '75.00', '1500.00'),
(53, 2017689575, 000113, 160, '60.50', '9680.00'),
(54, 2017689575, 000164, 40, '55.60', '2224.00'),
(55, 2017135635, 000165, 10, '26.00', '260.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_compras_detalle_temp`
--

CREATE TABLE `fin_compras_detalle_temp` (
  `cc_compras_det` int(3) UNSIGNED NOT NULL,
  `cc_codigo` varchar(50) NOT NULL DEFAULT '0',
  `cc_articulo` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ct_cantidad` decimal(10,2) DEFAULT '0.00',
  `ct_importe` decimal(10,2) DEFAULT '0.00',
  `ct_total` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_compras_detalle_temp`
--

INSERT INTO `fin_compras_detalle_temp` (`cc_compras_det`, `cc_codigo`, `cc_articulo`, `ct_cantidad`, `ct_importe`, `ct_total`) VALUES
(1, '2017284000', 0088, '1.00', '5.00', '5.00'),
(2, '2017886003', 0120, '60.00', '76.70', '4602.00'),
(3, '2017886003', 0164, '40.00', '55.60', '2224.00'),
(4, '2017886003', 0115, '60.00', '60.50', '3630.00'),
(5, '2017886003', 0114, '60.00', '41.00', '2460.00'),
(6, '2017886003', 0118, '20.00', '75.00', '1500.00'),
(7, '2017886003', 0113, '160.00', '60.50', '9680.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_comprobante`
--

CREATE TABLE `fin_comprobante` (
  `cc_comprobante` int(6) UNSIGNED NOT NULL,
  `ct_tipo` varchar(2) DEFAULT NULL,
  `ct_serie` varchar(5) DEFAULT NULL,
  `ct_documento` varchar(20) DEFAULT NULL,
  `ct_correlativo` int(11) DEFAULT NULL,
  `ct_vigencia` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_comprobante`
--

INSERT INTO `fin_comprobante` (`cc_comprobante`, `ct_tipo`, `ct_serie`, `ct_documento`, `ct_correlativo`, `ct_vigencia`) VALUES
(1, 'V', 'NC', 'Nota de venta', 102, '1'),
(2, 'V', 'FC', 'Factura', 1, '1'),
(3, 'V', 'BO', 'Boleta', 1, '1'),
(4, 'C', 'BO', 'Boleta', 1, '1'),
(5, 'C', 'FC', 'Factura', 1, '1'),
(6, 'C', 'RC', 'Recibo', 1, '0'),
(7, 'V', 'CR', 'Crédito', 102, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_documentos_de_venta`
--

CREATE TABLE `fin_documentos_de_venta` (
  `c_local` varchar(2) DEFAULT NULL,
  `cod_documento` varchar(2) NOT NULL,
  `num_documento` varchar(30) NOT NULL,
  `c_persona` varchar(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `c_usuario` varchar(10) DEFAULT NULL,
  `fecha_anula` datetime DEFAULT NULL,
  `c_usuario_anula` varchar(10) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `flag_centralizado` varchar(1) DEFAULT NULL,
  `flag_igv` varchar(1) DEFAULT NULL,
  `igv` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `obs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_documentos_de_venta_items`
--

CREATE TABLE `fin_documentos_de_venta_items` (
  `cod_documento` varchar(2) NOT NULL,
  `num_documento` varchar(30) NOT NULL,
  `linea` int(11) NOT NULL,
  `c_articulo` varchar(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `observacion` text,
  `cod_documento_ref` varchar(2) DEFAULT NULL,
  `num_documento_ref` varchar(11) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `mes_desde` varchar(2) DEFAULT NULL,
  `mes_hasta` varchar(2) DEFAULT NULL,
  `c_igv` varchar(1) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_documentos_de_venta_sustento`
--

CREATE TABLE `fin_documentos_de_venta_sustento` (
  `cod_documento` varchar(2) NOT NULL DEFAULT '',
  `num_documento` varchar(30) NOT NULL DEFAULT '',
  `linea` int(11) NOT NULL,
  `cod_forma_de_pago` varchar(2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `c_banco` varchar(6) DEFAULT NULL,
  `c_cta_corriente` varchar(24) DEFAULT NULL,
  `c_operacion` varchar(11) DEFAULT NULL,
  `fecha_referencia` datetime DEFAULT NULL,
  `ch_numero` varchar(10) DEFAULT NULL,
  `ch_banco` varchar(30) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_estado_cuenta`
--

CREATE TABLE `fin_estado_cuenta` (
  `id_c_operacion` int(11) NOT NULL,
  `cc_persona` int(11) DEFAULT NULL,
  `cod_tipo` varchar(2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cod_documento` varchar(2) DEFAULT NULL,
  `num_documento` varchar(30) DEFAULT NULL,
  `cod_documento_ref` varchar(2) DEFAULT NULL,
  `num_documento_ref` varchar(11) DEFAULT NULL,
  `referencia` text,
  `cargo_abono` varchar(2) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `c_local` varchar(2) DEFAULT NULL,
  `usuario` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_estado_cuenta`
--

INSERT INTO `fin_estado_cuenta` (`id_c_operacion`, `cc_persona`, `cod_tipo`, `fecha`, `cod_documento`, `num_documento`, `cod_documento_ref`, `num_documento_ref`, `referencia`, `cargo_abono`, `monto`, `flag`, `c_local`, `usuario`) VALUES
(1, 1, '99', '2018-06-01 00:00:00', '99', '000-06/2015', NULL, NULL, NULL, 'C', '10.00', NULL, '01', NULL),
(2, 1, '99', '2018-06-01 00:00:00', '99', '000-07/2016', NULL, NULL, NULL, 'C', '10.00', NULL, '01', NULL),
(3, 1, '99', '2018-06-01 00:00:00', '99', '000-08/2018', NULL, NULL, NULL, 'C', '10.00', NULL, '01', NULL),
(4, 1, '99', '2018-06-01 00:00:00', '99', '000-09/2018', NULL, NULL, NULL, 'C', '10.00', NULL, '01', NULL),
(5, 1, '99', '2018-06-01 00:00:00', '99', '000-01/2018', NULL, NULL, NULL, 'A', '10.00', NULL, '01', NULL),
(6, 1, '99', '2018-06-01 00:00:00', '99', '000-05/2018', NULL, NULL, NULL, 'A', '10.00', NULL, '01', NULL),
(7, 1, '99', '2018-06-01 00:00:00', '99', '000-01/2015', NULL, NULL, NULL, 'C', '10.00', NULL, '01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_estado_cuenta1`
--

CREATE TABLE `fin_estado_cuenta1` (
  `cc_estadocuenta` int(6) UNSIGNED ZEROFILL NOT NULL,
  `cc_caja` int(10) NOT NULL,
  `cc_persona` int(6) DEFAULT NULL,
  `ct_fecha` datetime DEFAULT NULL,
  `ct_tipo` varchar(2) DEFAULT NULL,
  `cc_descripcion` varchar(120) DEFAULT NULL,
  `ct_monto` decimal(10,2) DEFAULT NULL,
  `sys_user` varchar(15) DEFAULT NULL,
  `ct_vigencia` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fin_estado_cuenta1`
--

INSERT INTO `fin_estado_cuenta1` (`cc_estadocuenta`, `cc_caja`, `cc_persona`, `ct_fecha`, `ct_tipo`, `cc_descripcion`, `ct_monto`, `sys_user`, `ct_vigencia`) VALUES
(002033, 1, 25, '2017-11-21 15:34:01', 'D', NULL, '500.00', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fin_kardex`
--

CREATE TABLE `fin_kardex` (
  `cc_kardex` int(6) NOT NULL,
  `cc_articulo` int(6) DEFAULT NULL,
  `ct_tipo` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_articulo`
--

CREATE TABLE `gen_articulo` (
  `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_codigo` varchar(50) NOT NULL,
  `emp_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_grupo` varchar(2) DEFAULT '0',
  `ct_nombre` varchar(50) DEFAULT '0',
  `ct_molecula` varchar(50) DEFAULT '0',
  `ct_umedida` varchar(2) DEFAULT '0',
  `ct_compra` decimal(10,2) DEFAULT '0.00',
  `ct_rentabilidad` decimal(10,2) DEFAULT '0.00',
  `ct_venta` decimal(10,2) DEFAULT '0.00',
  `ct_stockmin` int(5) DEFAULT '0',
  `ct_stock` int(5) DEFAULT '0',
  `ct_igv` varchar(3) DEFAULT '0',
  `ct_vigencia` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_articulo`
--

INSERT INTO `gen_articulo` (`cc_articulo`, `ct_codigo`, `emp_id`, `ct_grupo`, `ct_nombre`, `ct_molecula`, `ct_umedida`, `ct_compra`, `ct_rentabilidad`, `ct_venta`, `ct_stockmin`, `ct_stock`, `ct_igv`, `ct_vigencia`) VALUES
(000001, 'E00001', 000012, '8', 'SUPER FIERRO  X LT', 'FIERRO', '02', '22.53', '37.59', '31.00', 10, 11, 'Si', '1'),
(000002, 'E00002', 000012, '8', 'SUPER ZINC X LT', 'ZINC', '02', '23.02', '30.32', '30.00', 10, 11, 'Si', '1'),
(000003, 'E00003', 000012, '8', 'SUPER MAGNESIO X LT', 'MAGNESIO', '02', '13.79', '45.03', '20.00', 10, 11, 'Si', '1'),
(000004, 'E00004', 000012, '8', 'NITROPLEX HOJA X LT', 'NITROGENO', '02', '12.71', '57.36', '20.00', 2, 9, 'Si', '1'),
(000005, 'E00005', 000012, '8', 'VITAFOS P450 X Lt', 'FOSFORO', '02', '14.90', '47.65', '22.00', 10, 1, 'Si', '1'),
(000006, 'E00006', 000012, '8', 'VITAFOL PLUS 35-10-10 X KG', 'NPK', '03', '7.24', '120.99', '16.00', 10, 23, 'No', '1'),
(000007, 'E00007', 000012, '8', 'VITAFOL PLUS 20-20-20 X KG', 'NPK', '03', '8.02', '111.97', '17.00', 10, 20, 'No', '1'),
(000008, 'E00008', 000012, '8', 'VITAFOL PLUS 10-55-10 X KG', 'NPK', '03', '10.99', '63.79', '18.00', 10, 13, 'No', '1'),
(000009, 'E00009', 000012, '8', 'VITAFOL PLUS 12-10-55 X KG', 'NPK', '03', '9.16', '74.67', '16.00', 10, 2, 'No', '1'),
(000010, 'E00010', 000005, '8', 'WUXAL CALCIO X KG', 'CALCIO', '02', '46.00', '23.91', '57.00', 10, 13, 'Si', '1'),
(000011, 'E00011', 000014, '8', 'FLORIPHOS X LT', 'FOSFORO', '02', '1.00', '0.00', '1.30', 10, 0, 'Si', '0'),
(000012, 'E00012', 000014, '8', 'HIDROX K X LT', 'POTASIO', '02', '21.18', '36.92', '29.00', 10, 2, 'Si', '1'),
(000013, 'E00013', 000017, '8', 'SUSTENTO CA-B X LT', 'CAL-B', '', '24.00', '58.33', '38.00', 10, 0, 'Si', '1'),
(000014, 'E00014', 000002, '8', 'PACKHARD X LT', 'CAL-B', '02', '32.00', '25.00', '40.00', 10, 265, 'Si', '1'),
(000015, 'E00015', 000002, '8', 'CARBOXY K X LT', 'POTASIO', '02', '31.56', '26.74', '40.00', 10, 38, 'Si', '1'),
(000016, 'E00016', 000002, '8', 'CARBOXY MAX X LT', 'KMBC', '02', '35.28', '47.39', '52.00', 10, 21, 'Si', '1'),
(000017, 'E00017', 000002, '8', 'CARBOXY CA X LT', 'CA', '02', '29.68', '28.03', '38.00', 10, 10, 'Si', '1'),
(000018, 'E00018', 000018, '8', 'NUTRIDOR 20-20-20 X LT', 'NPK', '', '19.51', '38.39', '27.00', 10, 0, 'Si', '1'),
(000019, 'E00019', 000018, '8', 'BORON X LT', 'BORO', '02', '30.70', '27.04', '39.00', 6, 3, 'Si', '1'),
(000020, 'E00020', 000005, '9', 'ANTRACOL X KG', 'PROPINED', '01', '38.00', '18.42', '45.00', 5, 7, 'Si', '1'),
(000021, 'E00021', 000004, '9', 'CERCOBIN X 200 GRS', 'THIOFANATE METHYL', '01', '36.00', '25.00', '45.00', 3, 11, 'Si', '1'),
(000022, 'E00022', 000004, '9', 'CERCOBIN X KG', 'THIOFANATE METHYL', '01', '150.00', '10.00', '165.00', 2, 4, 'Si', '1'),
(000023, 'E00023', 000010, '9', 'HIELOXIL X KG', 'METALAXIL+MANCOZED', '01', '55.00', '18.18', '65.00', 10, 11, 'Si', '1'),
(000024, 'E00024', 000019, '9', 'MERTEC X 100 ML', 'THIABENDAZOLE', '02', '47.50', '15.79', '55.00', 1, 0, 'Si', '1'),
(000025, 'E00025', 000005, '9', 'SUMISCLEX X KG', 'PROCYMIDONE', '01', '280.00', '2.86', '288.01', 10, 3, 'Si', '1'),
(000026, 'E00026', 000005, '9', 'FITORAZ X KG', 'CYMOZANIL+PROPINED', '01', '78.00', '17.95', '92.00', 10, 7, 'Si', '1'),
(000027, 'E00027', 000014, '9', 'GENTROL X LT', 'CHLOROTHALONIL+DIMETHOMORPH', '02', '60.77', '25.96', '76.55', 10, 12, 'Si', '1'),
(000028, 'E00028', 000017, '9', 'SEXTAN X LT', 'CARBENDAZIN', '02', '30.99', '45.21', '45.00', 0, 4, 'Si', '1'),
(000029, 'E00029', 000002, '9', 'FORDAZIN X LT', 'CARBENDAZIN', '02', '44.99', '26.69', '57.00', 10, 23, 'Si', '1'),
(000030, 'E00030', 000005, '9', 'PROSPER X LT', 'SPIROXAMINE', '02', '275.00', '4.36', '286.99', 5, 8, 'Si', '1'),
(000031, 'E00031', 000015, '9', 'GALBEN X KG', 'BENALAXIL+MANCOZED', '01', '56.00', '25.00', '70.00', 10, 3, 'Si', '1'),
(000032, 'E00032', 000014, '9', 'FOBOS X 200 GRS', 'IPRODIONE', '01', '24.63', '29.92', '32.00', 10, 8, 'Si', '1'),
(000033, 'E00033', 000002, '9', 'FUJI ONE X LT', 'ISOPROTHIOLANE', '02', '59.41', '26.24', '75.00', 10, 6, 'Si', '1'),
(000034, 'E00034', 000018, '9', 'EPICO X 100 GRS', 'TEBUCONAZOLE+AZOXYSTROBIN', '01', '46.05', '25.95', '58.00', 10, 15, 'Si', '1'),
(000035, 'E00035', 000018, '9', 'SULFA PLUS X KG', 'AZUFRE MOJABLE', '01', '13.43', '48.92', '20.00', 10, 5, 'Si', '1'),
(000036, 'E00036', 000018, '9', 'VERTICAL X 1/4', 'TEBUCONAZOLE', '02', '26.86', '26.58', '34.00', 10, 20, 'Si', '1'),
(000037, 'E00037', 000018, '9', 'CURTINE X KG', 'CYMOZANIL+MANCOZED', '01', '42.21', '25.56', '53.00', 10, 1, 'Si', '1'),
(000038, 'E00038', 000004, '9', 'vivando x lt', 'METRAFENONE', '', '1.00', '0.00', '1.30', 10, 0, 'Si', '1'),
(000039, 'E00039', 000018, '9', 'difeconazil x 1/4', 'DIFECONAZOLE', '02', '0.00', '0.00', '0.00', 10, 0, 'Si', '1'),
(000040, 'E00040', 000018, '9', 'difeconazil x lt', 'DIFECONAZOLE', '02', '0.00', '0.00', '0.00', 10, 0, 'Si', '1'),
(000041, 'E00041', 000018, '9', 'sulfato de cobre x kg', 'SULFATO DE COBRE PENTAHIDRATADO', '01', '8.80', '36.36', '12.00', 10, 13, 'Si', '1'),
(000042, 'E00042', 000005, '15', 'RYZ UP X 25 ML', 'ACIDI GEBERELICO', '02', '14.50', '37.93', '20.00', 10, 30, 'Si', '1'),
(000043, 'E00043', 000002, '15', 'FRUIT X LT', 'CITOQUININA+AUXINA+ACIDO GIBERELICO', '02', '197.95', '26.29', '249.99', 10, 12, 'Si', '1'),
(000044, 'E00044', 000002, '15', 'FRUIT X 1/4', 'CITOQUININA+AUXINA+ACIDO GIBERELICO', '02', '54.44', '26.75', '69.00', 10, 0, 'Si', '1'),
(000045, 'E00045', 000019, '15', 'biozyme x lt', 'CITOQUININA+AUXINA+ACIDO GIBERELICO', '02', '130.00', '23.08', '160.00', 3, 5, 'Si', '1'),
(000046, 'E00046', 000004, '15', 'DORMEX X LT', 'CIANAMIDA HIDROGENADA', '02', '33.00', '15.15', '38.00', 10, 13, 'Si', '1'),
(000047, 'E00047', 000012, '12', 'RANKILL X KG', 'PHENTHOATE', '01', '6.52', '114.72', '14.00', 6, 8, 'Si', '1'),
(000048, 'E00048', 000009, '12', 'CICLON X LT', 'DIMETHOATE', '02', '36.00', '25.00', '45.00', 6, 0, 'Si', '1'),
(000049, 'E00049', 000019, '12', 'MATCH X LT', 'LUFENURON', '02', '193.00', '13.99', '220.00', 4, 7, 'Si', '1'),
(000050, 'E00050', 000010, '12', 'ORTHENE X 100 GRS', 'ACEFATHE', '01', '11.50', '73.91', '20.00', 10, 5, 'Si', '1'),
(000051, 'E00051', 000010, '12', 'LANNATE X 100 GRS', 'METHOMILO', '01', '14.00', '21.43', '17.00', 10, 49, 'Si', '1'),
(000052, 'E00052', 000014, '12', 'PANIC X 1/4', 'ALPHACIPERMETRINA', '02', '14.31', '67.71', '24.00', 10, 6, 'Si', '1'),
(000053, 'E00053', 000014, '12', 'EVADE X 100 GRS', 'ACETAMIPRID', '01', '23.29', '11.00', '25.85', 10, 17, 'Si', '1'),
(000054, 'E00054', 000014, '12', 'VIVORAL X 100 GRS', 'THIAMETHOXAN', '01', '33.00', '25.10', '41.28', 10, 28, 'Si', '1'),
(000055, 'E00055', 000014, '12', 'TRIMAZINA X 100 GRS', 'CIROMAZINA', '02', '21.11', '27.90', '27.00', 10, 0, 'Si', '1'),
(000056, 'E00056', 000014, '12', 'REGLAN X 1/4', 'ABAMECTIN+EMAMECTIN BENZOATO', '02', '32.34', '29.87', '42.00', 10, 13, 'Si', '1'),
(000057, 'E00057', 000014, '12', 'PANIC X 1 LT', 'ALPHACIPERMETRINA', '02', '32.89', '43.79', '47.29', 10, 12, 'Si', '1'),
(000058, 'E00058', 000017, '12', 'ELITE X 200 GRS', 'IMIDACLOPRID+FIPRONIL', '01', '45.99', '30.46', '60.00', 10, 11, 'Si', '1'),
(000059, 'E00059', 000017, '12', 'LOVERA X 250 ML', 'THIAMETHOXAN+LAMDDA-CYHALOTHRIN', '02', '42.99', '27.94', '55.00', 10, 34, 'Si', '1'),
(000060, 'E00060', 000002, '12', 'ALFAKLING X LT', 'ALPHACIPERMETRINA', '02', '36.07', '52.48', '55.00', 10, 24, 'Si', '1'),
(000061, 'E00061', 000002, '12', 'ARPON X LT', 'OXAMIL', '02', '45.78', '31.06', '60.00', 6, 9, 'Si', '1'),
(000062, 'E00062', 000002, '12', 'SHOCKER X 100 GRS', 'METHOMILO', '01', '4.50', '144.44', '11.00', 10, 2, 'Si', '1'),
(000063, 'E00063', 000002, '12', 'QUETIN X LT', 'ABAMECTIN', '02', '40.59', '84.77', '75.00', 5, 5, 'Si', '1'),
(000064, 'E00064', 000018, '12', 'AKRON X 100 GRS', 'ACETAMIPRI+BUPROFEZIN', '01', '42.21', '25.56', '53.00', 6, 28, 'Si', '1'),
(000065, 'E00065', 000018, '12', 'COURAZE X 50 GRS', 'IMIDACLOPRID', '01', '21.11', '51.59', '32.00', 10, 1, 'Si', '1'),
(000066, 'E00066', 000018, '12', 'MATRIX X 250 ML', 'FIPRONIL', '02', '38.37', '25.10', '48.00', 3, 7, 'Si', '1'),
(000067, 'E00067', 000018, '12', 'RAPAZ X 250 ML', 'THIAMETHOXAN+LAMDDA-CYHALOTHRIN', '02', '51.80', '25.48', '65.00', 6, 27, 'Si', '1'),
(000068, 'E00068', 000018, '12', 'MAZON X 100 GRS', 'EMAMECTIN BENZOATE+LAMDDA-CYHALOTHRIN', '01', '42.21', '30.30', '55.00', 10, 19, 'Si', '1'),
(000069, 'E00069', 000018, '12', 'REZIO GOLD X 150 GRS', 'ABAMECTIN+CIROMAZINA', '01', '42.21', '30.30', '55.00', 10, 2, 'Si', '1'),
(000070, 'E00070', 000018, '12', 'THUNDER X LT', 'IMIDACLOPRID', '02', '92.10', '25.95', '116.00', 10, 1, 'Si', '1'),
(000071, 'E00071', 000018, '12', 'ZUXION X 250 ML ', 'IMIDACLOPRID', '01', '23.02', '25.98', '29.00', 10, 27, 'Si', '1'),
(000072, 'E00072', 000018, '12', 'dorsan x lt', 'CLORPYRIFOS', '02', '26.86', '26.58', '34.00', 10, 0, 'Si', '1'),
(000073, 'E00073', 000018, '12', 'dethomil x 100 grs', 'METHOMILO', '01', '6.00', '100.00', '12.00', 10, -1, 'Si', '1'),
(000074, 'E00074', 000002, '12', 'MATADOR X LT', 'METAMIDOPHOS', '02', '23.43', '31.28', '30.76', 10, 70, 'Si', '1'),
(000075, 'E00075', 000008, '12', 'bidrin x lt', 'DICROTOPHOS', '02', '132.00', '21.21', '160.00', 2, 4, 'Si', '1'),
(000076, 'E00076', 000019, '12', 'bidrin x 1/2 lt', 'DICROTOPHOS', '02', '73.47', '22.50', '90.00', 2, 0, 'Si', '1'),
(000077, 'E00077', 000018, '2', 'ACARISIL X 100 ML', 'ETOXAZOLE', '02', '57.56', '25.09', '72.00', 10, 29, 'Si', '1'),
(000078, 'E00078', 000014, '5', 'INCENTIVE X X LT', 'BIOCITOQUININA', '02', '92.09', '24.88', '115.00', 3, 8, 'Si', '1'),
(000079, 'E00079', 000014, '5', 'MEGAFOL X LT', 'EXTRACTOS VEGETALES', '02', '65.23', '25.71', '82.00', 6, 8, 'Si', '1'),
(000080, 'E00080', 000014, '5', 'PUNCHER X LT', 'NITROGENO VEGETAL', '02', '30.79', '36.41', '42.00', 6, 6, 'Si', '1'),
(000081, 'E00081', 000017, '5', 'VIBREL X LT', 'EXTRACTOS VEGETALES', '02', '81.90', '46.52', '120.00', 10, 9, 'Si', '1'),
(000082, 'E00082', 000002, '5', 'ATP UP X LT', 'ENERGETICO', '02', '51.73', '31.45', '68.00', 12, 10, 'Si', '1'),
(000083, 'E00083', 000018, '5', 'AGRISPON X LT', 'EXTRACTOS VEGETALES', '02', '107.45', '25.64', '135.00', 5, 2, 'Si', '1'),
(000084, 'E00084', 000018, '5', 'AGRISPON X 1/4', 'EXTRACTOS VEGETALES', '02', '30.70', '27.04', '39.00', 5, 27, 'Si', '1'),
(000085, 'E00085', 000019, '5', 'ORGABIOL X 1/4', 'PROMOTOR HORMONAL', '', '30.00', '40.00', '42.00', 10, 44, 'Si', '1'),
(000086, 'E00086', 000017, '5', 'RITMO X LT', 'ACIDO FOLICO', '02', '78.81', '25.83', '99.17', 2, 13, 'Si', '1'),
(000087, 'E00087', 000017, '5', 'RITMO X 200 ML', 'ACIDO FOLICO', '02', '25.42', '26.71', '32.21', 10, 45, 'Si', '1'),
(000088, 'E00088', 000003, '10', 'AMINA X LT', '2-4-D', '02', '22.50', '28.90', '29.00', 6, 6, 'Si', '1'),
(000089, 'E00089', 000010, '10', 'ROUNDOUP X LT', 'GLIFOSATO', '02', '26.00', '34.62', '35.00', 10, 11, 'Si', '1'),
(000090, 'E00090', 000019, '10', 'GESAPRIN X KG', 'ATRAZINA', '01', '56.00', '16.07', '65.00', 10, 2, 'Si', '1'),
(000091, 'E00091', 000011, '10', 'ERRASER x KG', 'GLIFOSATO', '01', '34.00', '32.35', '45.00', 10, -3, 'Si', '1'),
(000092, 'E00092', 000011, '10', 'KUARTEL X LT', 'GLUFOSINATE-AMMONIUM', '02', '48.00', '31.25', '63.00', 10, 11, 'Si', '1'),
(000093, 'E00093', 000001, '10', 'IGUANA X LT', 'PARAQUAT', '02', '25.00', '28.00', '32.00', 3, 7, 'Si', '1'),
(000094, 'E00094', 000002, '10', 'AMINAKLING X LT', '2-4-D', '02', '14.50', '72.41', '25.00', 10, 47, 'Si', '1'),
(000095, 'E00095', 000002, '10', 'GLITEC X LT', 'GLIFOSATO', '02', '13.98', '64.52', '23.00', 14, 28, 'Si', '1'),
(000096, 'E00096', 000002, '10', 'HERBAXONE X LT', 'PARAQUAT', '02', '17.76', '57.66', '28.00', 10, 41, 'Si', '1'),
(000097, 'E00097', 000018, '10', 'EMBATE X LT', 'GLIFOSATO', '02', '19.19', '35.49', '26.00', 10, 18, 'Si', '1'),
(000098, 'E00098', 000018, '10', 'EMBATE X 4 LTS', 'GLIFOSATO', '02', '69.07', '23.06', '85.00', 10, 2, 'Si', '1'),
(000099, 'E00099', 000018, '10', 'WESQUAT X LT', 'PARAQUAT', '02', '23.02', '25.98', '29.00', 10, 2, 'Si', '1'),
(000100, 'E00100', 000019, '10', 'accent x 40 grs', 'NICOSULFURON', '01', '80.00', '15.00', '92.00', 5, 10, 'Si', '1'),
(000101, 'E00101', 000015, '10', 'bounarroz x 4 lts', 'BUTACLOR', '02', '74.00', '21.62', '90.00', 2, 4, 'Si', '1'),
(000102, 'E00102', 000006, '10', 'comanche pack x 100 ml', 'BISPYRIBAC SODIO', '02', '44.00', '25.00', '55.00', 5, 0, 'Si', '1'),
(000103, 'E00103', 000012, '6', 'EC-OIL XLT', 'ACEITE VEGETAL', '02', '11.89', '68.21', '20.00', 10, 18, 'Si', '1'),
(000104, 'E00104', 000017, '3', 'VIGOR STIM X LT', 'ALGAS MARINA', '02', '35.59', '26.19', '44.91', 10, 8, 'Si', '1'),
(000105, 'E00105', 000012, '7', 'FULL DRY X LT', 'DETERGENTE', '02', '8.80', '104.55', '18.00', 10, 20, 'Si', '1'),
(000106, 'E00106', 000007, '13', 'cytored x lt', 'ENZIMAS VEGETALES', '02', '68.65', '67.52', '115.00', 10, -1, 'Si', '1'),
(000107, 'E00107', 000012, '16', 'ULTRAWET X LT', '', '02', '11.15', '34.53', '15.00', 0, 13, 'Si', '1'),
(000108, 'E00108', 000018, '16', 'TEMPLEX X LT', '', '02', '88.26', '24.63', '110.00', 10, 7, 'Si', '1'),
(000109, 'E00109', 000018, '16', 'TEMPLEX X 1/4', '', '02', '24.94', '28.31', '32.00', 10, 25, 'Si', '1'),
(000110, 'E00110', 000017, '4', 'SUSTENTO X LT', 'AMINOACIDOS', '02', '42.10', '42.52', '60.00', 10, 8, 'Si', '1'),
(000111, 'E00111', 000018, '14', 'AQUACID X LT', '', '02', '17.56', '42.37', '25.00', 6, 14, 'Si', '1'),
(000112, 'E00112', 000002, '14', 'ACID PH X LT', '', '02', '19.90', '25.63', '25.00', 5, 8, 'Si', '1'),
(000113, 'E00113', 000013, '1', 'UREA AGRICOLA X 50 KG', 'NITROGENO', '04', '60.50', '10.87', '67.08', 10, 149, 'No', '1'),
(000114, 'E00114', 000013, '1', 'SULFATO DE AMONIO X 50 KG', 'NITROGENO+AZUFRE', '04', '41.00', '7.61', '44.12', 10, 81, 'No', '1'),
(000115, 'E00115', 000013, '1', 'NITRATO DE AMONIO X 50 KG', 'NITROGENO AMONIACAL', '04', '60.50', '10.87', '67.08', 10, 78, 'No', '1'),
(000116, 'E00116', 000013, '1', 'CLORURO DE POTASIO ROJO X 50 KG', 'POTASIO', '04', '53.92', '11.28', '60.00', 10, 14, 'No', '1'),
(000117, 'E00117', 000013, '1', 'MOLIMAX 20-20-20 X 50 KG', 'NITROGENO+FOSFORO+POTASIO', '04', '71.30', '12.20', '80.00', 10, 7, 'No', '1'),
(000118, 'E00118', 000013, '1', 'SULFATO DE POTASIO Y MAGNESIO X 50 KG', 'POTASIO+MAGNESIO', '04', '75.00', '14.03', '85.52', 10, 14, 'No', '1'),
(000119, 'E00119', 000013, '1', 'SULFATO DE POTASIO GRANULAR X 50 KG', 'POTASIO', '04', '99.66', '12.38', '112.00', 10, 14, 'No', '1'),
(000120, 'E00120', 000013, '1', 'FOSFATO DE AMONICO X 50 KG', 'FOSFORO', '04', '76.70', '10.03', '84.39', 10, 65, 'No', '1'),
(000121, 'E00121', 000016, '10', 'boquilla regulable azul', '', '03', '4.24', '25.00', '5.30', 5, 21, 'Si', '1'),
(000122, 'E00122', 000016, '11', 'boquilla regulable amarilla', '', '03', '4.24', '42.86', '6.06', 6, 25, 'Si', '1'),
(000123, 'E00123', 000016, '11', 'boquilla regulable roja', '', '03', '4.24', '42.86', '6.06', 6, 23, 'Si', '1'),
(000124, 'E00124', 000016, '10', 'registro completo(manija)', '', '03', '4.24', '40.00', '5.94', 10, 4, 'Si', '1'),
(000125, 'E00006', 000005, '12', 'BETA BYTROIDE', '', '02', '148.00', '6.08', '157.00', 2, 5, 'Si', '1'),
(000126, 'E00007', 000002, '10', 'FLOZINA X LT ', 'GLIPHOSATO', '02', '19.42', '45.00', '28.16', 5, 21, 'Si', '1'),
(000127, 'S00001', 000005, '10', 'BASTA', 'GLIFOSATO', '02', '65.00', '15.38', '75.00', 5, 10, 'Si', '1'),
(000128, 'S00002', 000005, '2', 'FOLICUR X LT ', '', '01', '176.00', '6.00', '186.56', 2, 6, 'Si', '1'),
(000129, 'S00003', 000005, '2', 'FOLICUR X 250 ML', '', '02', '54.00', '25.00', '67.50', 0, 1, 'Si', '1'),
(000130, 'S00005', 000018, '2', 'KALEX X LT ', 'ACIDOS ECCA', '02', '53.00', '15.00', '60.95', 0, 1, 'Si', '1'),
(000131, 'S00006', 000019, '2', 'KLERAT X 10 GR ', 'NICOSULFURON', '01', '2.80', '45.00', '4.06', 0, 0, 'Si', '1'),
(000132, 'S00007', 000005, '2', 'LARVIN X LT ', 'THIODICAR, 375 G/L', '02', '134.00', '8.00', '144.72', 0, 10, 'Si', '1'),
(000133, 'S00008', 000009, '2', 'MALATHION X KG', '', '01', '9.00', '33.28', '12.00', 0, 2, 'Si', '1'),
(000134, 'S00009', 000019, '2', 'MERTECT X LT', '', '02', '375.00', '12.00', '420.00', 1, 1, 'Si', '1'),
(000135, 'S00010', 000014, '2', 'PALADIN X LT', '', '02', '24.00', '48.00', '35.52', 0, 17, 'Si', '1'),
(000136, 'S00011', 000019, '2', 'PARACHUPADERA POR 200GR', '', '01', '21.83', '38.00', '30.13', 0, 24, 'Si', '1'),
(000137, 'S00012', 000018, '2', 'POUNTRIL X TABLETA', '', '03', '2.17', '300.00', '8.68', 0, 92, 'Si', '1'),
(000138, 'S00013', 000019, '9', 'RANCHAPAJ POR KG', '', '01', '44.55', '30.00', '57.92', 2, 21, 'Si', '1'),
(000139, 'S00013', 000019, '2', 'SCORE X LT', '', '02', '330.00', '7.50', '354.75', 0, 1, 'Si', '1'),
(000140, 'S00013', 000019, '3', 'SPARTACO X 400 GR', '', '01', '31.00', '32.00', '40.92', 0, 11, 'Si', '1'),
(000141, 'S00014', 000005, '5', 'SUMISCLEX X 250 ML', '', '02', '68.00', '18.00', '80.24', 0, 11, 'Si', '1'),
(000142, 'S00015', 000018, '5', 'TIFON X 10 KG', '', '04', '34.00', '18.00', '40.12', 0, 0, 'Si', '1'),
(000143, 'S00014', 000005, '1', 'WUXAL ASCOFOL X LT', '', '02', '73.00', '15.00', '83.95', 0, 10, 'Si', '1'),
(000144, 'S00015', 000005, '1', 'WUXAL NITROPLAN X LT', '', '02', '58.00', '25.00', '72.50', 0, 9, 'Si', '1'),
(000145, 'S00016', 000002, '12', 'AFIDON', 'DIMETHOATO', '02', '35.00', '28.58', '45.00', 4, 10, 'Si', '1'),
(000146, 'S00017', 000016, '1', 'CILINDRO DE MOCHILA', '', '03', '32.20', '33.00', '42.83', 0, 3, 'Si', '1'),
(000147, 'S00018', 000016, '1', 'REGISTRO COMPLETO', '', '03', '16.95', '75.00', '29.66', 0, 5, 'Si', '1'),
(000148, 'S00019', 000016, '1', 'GAXETA', '', '03', '1.69', '100.00', '3.38', 0, 20, 'Si', '1'),
(000149, 'S00020', 000016, '3', 'JUEGO DE EMBOLO', '', '03', '4.24', '80.00', '7.63', 0, 17, 'Si', '1'),
(000150, 'S00021', 000016, '1', 'MANIJA DE BOMBA', '', '03', '5.00', '80.00', '9.00', 0, 0, 'Si', '1'),
(000151, 'S00021', 000002, '9', 'FORSEM X KG ', '', '01', '41.51', '25.00', '51.89', 0, 12, 'Si', '1'),
(000152, 'S00021', 000014, '2', 'BENTRAGRAN X LT ', '', '02', '58.98', '25.00', '73.73', 0, 12, 'Si', '1'),
(000153, 'S00021', 000014, '10', 'PACK ARROCERO X 200 ML', '', '03', '37.12', '25.00', '46.40', 0, 23, 'Si', '1'),
(000154, 'S00021', 000014, '8', 'FLORIPHOS FRASCO X LT ', '', '02', '22.69', '28.00', '29.04', 0, 12, 'Si', '1'),
(000155, 'S00022', 000014, '4', 'OCTANO X KG ', '', '01', '26.93', '25.00', '33.66', 0, 18, 'Si', '1'),
(000156, 'S00021', 000017, '3', 'SUSTENTO CA-B SP X 1 KG ', '', '01', '26.30', '30.00', '34.19', 0, 6, 'Si', '1'),
(000157, 'S00022', 000017, '3', 'SUSTENTO RAIZ X LT ', '', '02', '42.37', '25.00', '52.96', 0, 12, 'Si', '1'),
(000158, 'S00023', 000017, '14', 'HUMIC GROW - POTASSIUM HUMATE X 250 ML', '', '02', '122.88', '28.00', '157.29', 0, 4, 'Si', '1'),
(000159, 'S00024', 000017, '3', 'CLIPPER 500EC X 250 ML ', '', '02', '47.46', '28.00', '60.75', 0, 7, 'Si', '1'),
(000160, 'S00024', 000017, '2', 'HELIOS 76PM X 1KG ', '', '01', '42.37', '25.00', '52.96', 0, 10, 'Si', '1'),
(000161, 'S00025', 000002, '2', 'CARBOXY B', '', '02', '26.80', '40.00', '37.52', 0, 12, 'Si', '1'),
(000162, 'S00026', 000002, '2', 'RADIGROW', '', '02', '89.42', '28.00', '114.46', 0, 12, 'Si', '1'),
(000163, 'S00026', 000002, '2', 'CARBOXY MG', '', '02', '17.49', '30.00', '22.74', 0, 46, 'Si', '1'),
(000164, 'S00027', 000013, '1', 'MOLIMAX NITROS X 50KG', '', '04', '55.60', '62.00', '90.07', 0, 35, 'No', '1'),
(000165, 'S00029', 000020, '1', 'SULFATO DE MAGESIO SOLUBLE POR 25KG ', '', '04', '26.00', '15.50', '30.03', 0, 9, 'Si', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_articulo1`
--

CREATE TABLE `gen_articulo1` (
  `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_codigo` varchar(50) NOT NULL,
  `emp_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_grupo` varchar(2) DEFAULT '0',
  `ct_nombre` varchar(50) DEFAULT '0',
  `ct_molecula` varchar(50) DEFAULT '0',
  `ct_umedida` varchar(2) DEFAULT '0',
  `ct_compra` decimal(10,2) DEFAULT '0.00',
  `ct_rentabilidad` decimal(10,2) DEFAULT '0.00',
  `ct_venta` decimal(10,2) DEFAULT '0.00',
  `ct_stockmin` int(5) DEFAULT '0',
  `ct_stock` int(5) DEFAULT '0',
  `ct_igv` varchar(3) DEFAULT '0',
  `ct_vigencia` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_articulo1`
--

INSERT INTO `gen_articulo1` (`cc_articulo`, `ct_codigo`, `emp_id`, `ct_grupo`, `ct_nombre`, `ct_molecula`, `ct_umedida`, `ct_compra`, `ct_rentabilidad`, `ct_venta`, `ct_stockmin`, `ct_stock`, `ct_igv`, `ct_vigencia`) VALUES
(000001, '', 000000, '0', '0', '0', '0', '22.53', '37.59', '31.00', 6, 18, '0', '0'),
(000002, '', 000000, '0', '0', '0', '0', '23.02', '30.32', '30.00', 10, 11, '0', '0'),
(000003, '', 000000, '0', '0', '0', '0', '13.79', '45.03', '20.00', 10, 11, '0', '0'),
(000004, '', 000000, '0', '0', '0', '0', '12.71', '57.36', '20.00', 10, 11, '0', '0'),
(000005, '', 000000, '0', '0', '0', '0', '14.90', '47.65', '22.00', 10, 11, '0', '0'),
(000006, '', 000000, '0', '0', '0', '0', '7.24', '120.99', '16.00', 10, 11, '0', '0'),
(000007, '', 000000, '0', '0', '0', '0', '8.02', '111.97', '17.00', 10, 11, '0', '0'),
(000008, '', 000000, '0', '0', '0', '0', '10.99', '63.79', '18.00', 10, 11, '0', '0'),
(000009, '', 000000, '0', '0', '0', '0', '9.16', '74.67', '16.00', 10, 11, '0', '0'),
(000010, '', 000000, '0', '0', '0', '0', '46.00', '23.91', '57.00', 10, 11, '0', '0'),
(000011, '', 000000, '0', '0', '0', '0', '1.00', '0.00', '1.00', 10, 11, '0', '0'),
(000012, '', 000000, '0', '0', '0', '0', '21.18', '36.92', '29.00', 10, 11, '0', '0'),
(000013, '', 000000, '0', '0', '0', '0', '24.00', '58.33', '38.00', 10, 11, '0', '0'),
(000014, '', 000000, '0', '0', '0', '0', '31.89', '34.84', '43.00', 10, 10, '0', '0'),
(000015, '', 000000, '0', '0', '0', '0', '31.56', '26.74', '40.00', 10, 11, '0', '0'),
(000016, '', 000000, '0', '0', '0', '0', '35.28', '47.39', '52.00', 10, 11, '0', '0'),
(000017, '', 000000, '0', '0', '0', '0', '29.68', '28.03', '38.00', 10, 11, '0', '0'),
(000018, '', 000000, '0', '0', '0', '0', '19.51', '38.39', '27.00', 10, 11, '0', '0'),
(000019, '', 000000, '0', '0', '0', '0', '30.70', '27.04', '39.00', 10, 11, '0', '0'),
(000020, '', 000000, '0', '0', '0', '0', '38.00', '18.42', '45.00', 10, 13, '0', '0'),
(000021, '', 000000, '0', '0', '0', '0', '36.00', '25.00', '45.00', 10, 12, '0', '0'),
(000022, '', 000000, '0', '0', '0', '0', '150.00', '10.00', '165.00', 10, 12, '0', '0'),
(000023, '', 000000, '0', '0', '0', '0', '55.00', '18.18', '65.00', 10, 11, '0', '0'),
(000024, '', 000000, '0', '0', '0', '0', '47.50', '15.79', '55.00', 10, 11, '0', '0'),
(000025, '', 000000, '0', '0', '0', '0', '280.00', '2.86', '288.00', 10, 11, '0', '0'),
(000026, '', 000000, '0', '0', '0', '0', '78.00', '17.95', '92.00', 10, 12, '0', '0'),
(000027, '', 000000, '0', '0', '0', '0', '70.66', '25.96', '89.00', 10, 11, '0', '0'),
(000028, '', 000000, '0', '0', '0', '0', '30.99', '45.21', '45.00', 10, 11, '0', '0'),
(000029, '', 000000, '0', '0', '0', '0', '44.99', '26.69', '57.00', 10, 11, '0', '0'),
(000030, '', 000000, '0', '0', '0', '0', '275.00', '4.36', '287.00', 10, 11, '0', '0'),
(000031, '', 000000, '0', '0', '0', '0', '56.00', '25.00', '70.00', 10, 11, '0', '0'),
(000032, '', 000000, '0', '0', '0', '0', '24.63', '29.92', '32.00', 10, 11, '0', '0'),
(000033, '', 000000, '0', '0', '0', '0', '59.41', '26.24', '75.00', 10, 11, '0', '0'),
(000034, '', 000000, '0', '0', '0', '0', '46.05', '25.95', '58.00', 10, 11, '0', '0'),
(000035, '', 000000, '0', '0', '0', '0', '13.43', '48.92', '20.00', 10, 11, '0', '0'),
(000036, '', 000000, '0', '0', '0', '0', '26.86', '26.58', '34.00', 10, 11, '0', '0'),
(000037, '', 000000, '0', '0', '0', '0', '42.21', '25.56', '53.00', 10, 11, '0', '0'),
(000038, '', 000000, '0', '0', '0', '0', '1.00', '0.00', '1.00', 10, 11, '0', '0'),
(000039, '', 000000, '0', '0', '0', '0', '38.37', '30.31', '50.00', 10, 11, '0', '0'),
(000040, '', 000000, '0', '0', '0', '0', '1.00', '0.00', '1.00', 10, 11, '0', '0'),
(000041, '', 000000, '0', '0', '0', '0', '8.80', '36.36', '12.00', 10, 11, '0', '0'),
(000042, '', 000000, '0', '0', '0', '0', '14.50', '37.93', '20.00', 10, 11, '0', '0'),
(000043, '', 000000, '0', '0', '0', '0', '197.95', '26.29', '250.00', 10, 11, '0', '0'),
(000044, '', 000000, '0', '0', '0', '0', '54.44', '26.75', '69.00', 10, 11, '0', '0'),
(000045, '', 000000, '0', '0', '0', '0', '130.00', '23.08', '160.00', 10, 11, '0', '0'),
(000046, '', 000000, '0', '0', '0', '0', '33.00', '15.15', '38.00', 10, 1, '0', '0'),
(000047, '', 000000, '0', '0', '0', '0', '6.52', '114.72', '14.00', 10, 11, '0', '0'),
(000048, '', 000000, '0', '0', '0', '0', '36.00', '25.00', '45.00', 10, 1, '0', '0'),
(000049, '', 000000, '0', '0', '0', '0', '193.00', '13.99', '220.00', 10, 7, '0', '0'),
(000050, '', 000000, '0', '0', '0', '0', '11.50', '73.91', '20.00', 10, 5, '0', '0'),
(000051, '', 000000, '0', '0', '0', '0', '14.00', '21.43', '17.00', 10, 57, '0', '0'),
(000052, '', 000000, '0', '0', '0', '0', '14.31', '67.71', '24.00', 10, 16, '0', '0'),
(000053, '', 000000, '0', '0', '0', '0', '23.29', '37.40', '32.00', 10, 19, '0', '0'),
(000054, '', 000000, '0', '0', '0', '0', '38.37', '25.10', '48.00', 10, 10, '0', '0'),
(000055, '', 000000, '0', '0', '0', '0', '21.11', '27.90', '27.00', 10, 0, '0', '0'),
(000056, '', 000000, '0', '0', '0', '0', '32.34', '29.87', '42.00', 10, 15, '0', '0'),
(000057, '', 000000, '0', '0', '0', '0', '38.25', '43.79', '55.00', 10, 2, '0', '0'),
(000058, '', 000000, '0', '0', '0', '0', '45.99', '30.46', '60.00', 10, 25, '0', '0'),
(000059, '', 000000, '0', '0', '0', '0', '42.99', '27.94', '55.00', 10, 37, '0', '0'),
(000060, '', 000000, '0', '0', '0', '0', '36.07', '52.48', '55.00', 10, 24, '0', '0'),
(000061, '', 000000, '0', '0', '0', '0', '45.78', '31.06', '60.00', 10, 10, '0', '0'),
(000062, '', 000000, '0', '0', '0', '0', '4.50', '144.44', '11.00', 10, 27, '0', '0'),
(000063, '', 000000, '0', '0', '0', '0', '40.59', '84.77', '75.00', 10, 8, '0', '0'),
(000064, '', 000000, '0', '0', '0', '0', '42.21', '25.56', '53.00', 10, 28, '0', '0'),
(000065, '', 000000, '0', '0', '0', '0', '21.11', '51.59', '32.00', 10, 1, '0', '0'),
(000066, '', 000000, '0', '0', '0', '0', '38.37', '25.10', '48.00', 10, 9, '0', '0'),
(000067, '', 000000, '0', '0', '0', '0', '51.80', '25.48', '65.00', 10, 30, '0', '0'),
(000068, '', 000000, '0', '0', '0', '0', '42.21', '30.30', '55.00', 10, 21, '0', '0'),
(000069, '', 000000, '0', '0', '0', '0', '42.21', '30.30', '55.00', 10, 2, '0', '0'),
(000070, '', 000000, '0', '0', '0', '0', '92.10', '25.95', '116.00', 10, 6, '0', '0'),
(000071, '', 000000, '0', '0', '0', '0', '23.02', '25.98', '29.00', 10, 28, '0', '0'),
(000072, '', 000000, '0', '0', '0', '0', '26.86', '26.58', '34.00', 10, 1, '0', '0'),
(000073, '', 000000, '0', '0', '0', '0', '6.00', '100.00', '12.00', 10, 1, '0', '0'),
(000074, '', 000000, '0', '0', '0', '0', '26.66', '31.28', '35.00', 10, 72, '0', '0'),
(000075, '', 000000, '0', '0', '0', '0', '132.00', '21.21', '160.00', 10, 11, '0', '0'),
(000076, '', 000000, '0', '0', '0', '0', '73.47', '22.50', '90.00', 10, 4, '0', '0'),
(000077, '', 000000, '0', '0', '0', '0', '57.56', '25.09', '72.00', 10, 29, '0', '0'),
(000078, '', 000000, '0', '0', '0', '0', '92.09', '24.88', '115.00', 10, 8, '0', '0'),
(000079, '', 000000, '0', '0', '0', '0', '65.23', '25.71', '82.00', 10, 8, '0', '0'),
(000080, '', 000000, '0', '0', '0', '0', '30.79', '36.41', '42.00', 10, 6, '0', '0'),
(000081, '', 000000, '0', '0', '0', '0', '81.90', '46.52', '120.00', 10, 10, '0', '0'),
(000082, '', 000000, '0', '0', '0', '0', '51.73', '31.45', '68.00', 10, 18, '0', '0'),
(000083, '', 000000, '0', '0', '0', '0', '107.45', '25.64', '135.00', 10, 10, '0', '0'),
(000084, '', 000000, '0', '0', '0', '0', '30.70', '27.04', '39.00', 10, 27, '0', '0'),
(000085, '', 000000, '0', '0', '0', '0', '30.00', '40.00', '42.00', 10, 46, '0', '0'),
(000086, '', 000000, '0', '0', '0', '0', '92.98', '25.83', '117.00', 10, 4, '0', '0'),
(000087, '', 000000, '0', '0', '0', '0', '29.99', '26.71', '38.00', 10, 35, '0', '0'),
(000088, '', 000000, '0', '0', '0', '0', '22.50', '28.89', '29.00', 10, 17, '0', '0'),
(000089, '', 000000, '0', '0', '0', '0', '26.00', '34.62', '35.00', 10, 20, '0', '0'),
(000090, '', 000000, '0', '0', '0', '0', '56.00', '16.07', '65.00', 10, 7, '0', '0'),
(000091, '', 000000, '0', '0', '0', '0', '34.00', '32.35', '45.00', 10, 9, '0', '0'),
(000092, '', 000000, '0', '0', '0', '0', '48.00', '31.25', '63.00', 10, 17, '0', '0'),
(000093, '', 000000, '0', '0', '0', '0', '25.00', '28.00', '32.00', 10, 7, '0', '0'),
(000094, '', 000000, '0', '0', '0', '0', '14.50', '72.41', '25.00', 10, 52, '0', '0'),
(000095, '', 000000, '0', '0', '0', '0', '13.98', '64.52', '23.00', 10, 39, '0', '0'),
(000096, '', 000000, '0', '0', '0', '0', '17.76', '57.66', '28.00', 10, 48, '0', '0'),
(000097, '', 000000, '0', '0', '0', '0', '19.19', '35.49', '26.00', 10, 19, '0', '0'),
(000098, '', 000000, '0', '0', '0', '0', '69.07', '23.06', '85.00', 10, 3, '0', '0'),
(000099, '', 000000, '0', '0', '0', '0', '23.02', '25.98', '29.00', 10, 10, '0', '0'),
(000100, '', 000000, '0', '0', '0', '0', '80.00', '15.00', '92.00', 10, 11, '0', '0'),
(000101, '', 000000, '0', '0', '0', '0', '74.00', '21.62', '90.00', 10, 5, '0', '0'),
(000102, '', 000000, '0', '0', '0', '0', '44.00', '36.36', '60.00', 10, 11, '0', '0'),
(000103, '', 000000, '0', '0', '0', '0', '11.89', '68.21', '20.00', 10, 19, '0', '0'),
(000104, '', 000000, '0', '0', '0', '0', '42.00', '26.19', '53.00', 10, 3, '0', '0'),
(000105, '', 000000, '0', '0', '0', '0', '8.80', '104.55', '18.00', 10, 20, '0', '0'),
(000106, '', 000000, '0', '0', '0', '0', '68.65', '67.52', '115.00', 10, 3, '0', '0'),
(000107, '', 000000, '0', '0', '0', '0', '11.15', '34.53', '15.00', 10, 14, '0', '0'),
(000108, '', 000000, '0', '0', '0', '0', '88.26', '24.63', '110.00', 10, 8, '0', '0'),
(000109, '', 000000, '0', '0', '0', '0', '24.94', '28.31', '32.00', 10, 28, '0', '0'),
(000110, '', 000000, '0', '0', '0', '0', '42.10', '42.52', '60.00', 10, 11, '0', '0'),
(000111, '', 000000, '0', '0', '0', '0', '17.56', '42.37', '25.00', 10, 16, '0', '0'),
(000112, '', 000000, '0', '0', '0', '0', '19.90', '25.63', '25.00', 10, 9, '0', '0'),
(000113, '', 000000, '0', '0', '0', '0', '56.37', '10.87', '62.50', 10, 108, '0', '0'),
(000114, '', 000000, '0', '0', '0', '0', '40.89', '7.61', '44.00', 10, 59, '0', '0'),
(000115, '', 000000, '0', '0', '0', '0', '56.37', '10.87', '62.50', 10, 52, '0', '0'),
(000116, '', 000000, '0', '0', '0', '0', '53.92', '11.28', '60.00', 10, 20, '0', '0'),
(000117, '', 000000, '0', '0', '0', '0', '71.30', '12.20', '80.00', 10, 10, '0', '0'),
(000118, '', 000000, '0', '0', '0', '0', '74.54', '14.03', '85.00', 10, 7, '0', '0'),
(000119, '', 000000, '0', '0', '0', '0', '99.66', '12.38', '112.00', 10, 16, '0', '0'),
(000120, '', 000000, '0', '0', '0', '0', '72.71', '10.03', '80.00', 10, 12, '0', '0'),
(000121, '', 000000, '0', '0', '0', '0', '24.00', '25.00', '30.00', 0, 10, '0', '0'),
(000122, '', 000000, '0', '0', '0', '0', '7.00', '42.86', '10.00', 10, 11, '0', '0'),
(000123, '', 000000, '0', '0', '0', '0', '7.00', '42.86', '10.00', 10, 11, '0', '0'),
(000124, '', 000000, '0', '0', '0', '0', '7.00', '42.86', '10.00', 10, 11, '0', '0'),
(000125, '', 000000, '0', '0', '0', '0', '18.00', '38.89', '25.00', 10, 11, '0', '0'),
(000126, '', 000000, '0', '0', '0', '0', '38.00', '18.42', '45.00', 0, 0, '0', '0'),
(000127, '', 000000, '0', '0', '0', '0', '2.00', '150.00', '5.00', 0, 0, '0', '0'),
(000128, '', 000000, '0', '0', '0', '0', '5.00', '40.00', '7.00', 0, 0, '0', '0'),
(000129, '', 000000, '0', '0', '0', '0', '5.00', '40.00', '7.00', 0, 0, '0', '0'),
(000130, '', 000000, '0', '0', '0', '0', '22.20', '57.66', '35.00', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_documentos_internos`
--

CREATE TABLE `gen_documentos_internos` (
  `linea` int(11) NOT NULL,
  `c_tipo` varchar(2) NOT NULL,
  `c_local` varchar(2) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `cc_persona` varchar(6) NOT NULL,
  `vigencia` varchar(2) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `c_usuario` varchar(10) DEFAULT NULL,
  `fecha_anula` datetime DEFAULT NULL,
  `c_usuario_anula` varchar(10) DEFAULT NULL,
  `cod_documento` varchar(2) NOT NULL,
  `num_documento` varchar(30) NOT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `caducidad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_empresa`
--

CREATE TABLE `gen_empresa` (
  `emp_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `emp_razon_social` varchar(200) NOT NULL,
  `emp_nom_comercial` varchar(200) DEFAULT NULL,
  `emp_ruc` varchar(12) NOT NULL,
  `emp_direccion` varchar(150) DEFAULT NULL,
  `emp_telefono` varchar(15) DEFAULT NULL,
  `emp_celular` varchar(15) DEFAULT NULL,
  `emp_email` varchar(45) DEFAULT NULL,
  `emp_web` varchar(120) DEFAULT NULL,
  `emp_estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_empresa`
--

INSERT INTO `gen_empresa` (`emp_id`, `emp_razon_social`, `emp_nom_comercial`, `emp_ruc`, `emp_direccion`, `emp_telefono`, `emp_celular`, `emp_email`, `emp_web`, `emp_estado`) VALUES
(000001, 'ADAMA', 'ADAMA', '10000000001', 'prueba', '', '', '', '', '1'),
(000002, 'AGROKLINGE', 'AGROKLINGE', '10000000002', NULL, NULL, NULL, NULL, NULL, '1'),
(000003, 'ARIS', 'ARIS', '10000000003', '', '', '', '', '', '1'),
(000004, 'BASF', 'BASF', '10000000004', NULL, NULL, NULL, NULL, NULL, '1'),
(000005, 'BAYER', 'BAYER', '10000000005', NULL, NULL, NULL, NULL, NULL, '1'),
(000006, 'CAPEAGRO', 'CAPEAGRO', '10000000006', NULL, NULL, NULL, NULL, NULL, '1'),
(000007, 'CYTOPERU', 'CYTOPERU', '10000000007', NULL, NULL, NULL, NULL, NULL, '1'),
(000008, 'DROKASA', 'DROKASA', '10000000008', NULL, NULL, NULL, NULL, NULL, '1'),
(000009, 'FARMAGRO', 'FARMAGRO', '10000000009', NULL, NULL, NULL, NULL, NULL, '1'),
(000010, 'FARMEX', 'FARMEX', '10000000010', NULL, NULL, NULL, NULL, NULL, '1'),
(000011, 'INTEROC CUSTER', 'INTEROC CUSTER', '10000000011', NULL, NULL, NULL, NULL, NULL, '1'),
(000012, 'ITAGRO', 'ITAGRO', '10000000012', NULL, NULL, NULL, NULL, NULL, '1'),
(000013, 'MOLINOS', 'MOLINOS', '10000000013', NULL, NULL, NULL, NULL, NULL, '1'),
(000014, 'MONTANA', 'MONTANA', '10000000014', NULL, NULL, NULL, NULL, NULL, '1'),
(000015, 'NEOAGRUM', 'NEOAGRUM', '10000000015', NULL, NULL, NULL, NULL, NULL, '1'),
(000016, 'PICON', 'PICON', '10000000016', NULL, NULL, NULL, NULL, NULL, '1'),
(000017, 'POINT ANDINA', 'POINT ANDINA', '10000000017', NULL, NULL, NULL, NULL, NULL, '1'),
(000018, 'SILVESTRE', 'SILVESTRE', '10000000018', NULL, NULL, NULL, NULL, NULL, '1'),
(000019, 'TQC', 'TQC', '10000000019', NULL, NULL, NULL, NULL, NULL, '1'),
(000020, 'YARA PERU SAC', 'YARA PERU ', '20000000009', 'prueba', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_grupo`
--

CREATE TABLE `gen_grupo` (
  `cc_grupo` int(6) NOT NULL,
  `ct_nombre` varchar(100) NOT NULL,
  `cfl_vigencia` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_grupo`
--

INSERT INTO `gen_grupo` (`cc_grupo`, `ct_nombre`, `cfl_vigencia`) VALUES
(1, 'Abonos sintéticos', 1),
(2, 'Acaricida', 1),
(3, 'Algas marinas', 1),
(4, 'Aminoácidos', 1),
(5, 'Bioestimulantes', 1),
(6, 'Coayudante agrícola', 1),
(7, 'Detergente agrícola', 1),
(8, 'Foliares', 1),
(9, 'Fungicidas', 1),
(10, 'Herbicidas', 1),
(11, 'Herramientas', 1),
(12, 'Insecticidas', 1),
(13, 'Potenciador color', 1),
(14, 'Regulador agua', 1),
(15, 'Regulador de crecimiento', 1),
(16, 'Surfectante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_parametro`
--

CREATE TABLE `gen_parametro` (
  `cc_parametro` varchar(10) NOT NULL,
  `ct_parametro` varchar(70) NOT NULL,
  `ct_descripcion` varchar(500) DEFAULT NULL,
  `cfl_vigencia` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_parametro`
--

INSERT INTO `gen_parametro` (`cc_parametro`, `ct_parametro`, `ct_descripcion`, `cfl_vigencia`) VALUES
('1', 'tipo documento', 'Documento de indentidad', 1),
('2', 'Sexo', NULL, 1),
('3', 'Estado', 'activo y inactivo', 1),
('4', 'estado Civil', NULL, 1),
('5', 'Tipo', 'Tipo de registro de persona colegiado empresa', 1),
('6', 'AFP', 'Registro de AFP', 1),
('7', 'Tipo de Dir', 'Tipo de direccion del domicilio', 1),
('8', 'Tipo dom', 'Tipo de domicilio', 1),
('9', 'Factor Sanguinero', 'Factor sanguinero', 1),
('10', 'Estado persona', 'Estado vivo muerto, cesante ect', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_parametro_det`
--

CREATE TABLE `gen_parametro_det` (
  `cc_par_det` int(5) NOT NULL COMMENT 'corre de acuerdo a parametro',
  `cc_parametro` varchar(10) NOT NULL,
  `cc_codigo` varchar(5) NOT NULL,
  `ct_par_det` varchar(45) DEFAULT NULL,
  `ct_par_det_corto` varchar(10) DEFAULT NULL,
  `nn_orden` int(3) UNSIGNED DEFAULT NULL,
  `cfl_vigencia` int(2) UNSIGNED DEFAULT '0',
  `cc_usuario_audit` int(11) DEFAULT NULL,
  `df_log` datetime DEFAULT NULL,
  `ct_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_parametro_det`
--

INSERT INTO `gen_parametro_det` (`cc_par_det`, `cc_parametro`, `cc_codigo`, `ct_par_det`, `ct_par_det_corto`, `nn_orden`, `cfl_vigencia`, `cc_usuario_audit`, `df_log`, `ct_ip`) VALUES
(1, '1', 'DI', 'Documento Nacional de Identidad', 'DNI', 1, 1, NULL, '2018-06-10 08:38:14', NULL),
(2, '1', 'CE', 'Carnet de Extrajeria', 'Carnet de ', 2, 1, NULL, '2018-06-10 08:38:13', NULL),
(3, '2', 'M', 'Masculino', 'Masculino', 1, 1, NULL, '2018-06-10 08:38:12', NULL),
(4, '2', 'F', 'Femenino', 'Femenino', 2, 1, NULL, '2018-06-10 08:38:12', NULL),
(5, '4', '01', 'Soltero', 'Soltero', 1, 1, NULL, '2018-06-10 08:38:11', NULL),
(6, '4', '02', 'Casado', 'Casado', 2, 1, NULL, '2017-01-30 23:09:44', NULL),
(7, '4', '03', 'Viuda(o)', 'Viuda(o)', 3, 1, NULL, '2017-01-30 23:10:00', NULL),
(8, '4', '04', 'Divorciado', 'Divorciado', 4, 1, NULL, '2017-01-30 23:11:05', NULL),
(9, '4', '05', 'Conviviente', 'Convivient', 5, 1, NULL, '2018-06-10 08:38:09', NULL),
(10, '5', 'COL', 'Colegiado', 'Colegiado', 1, 1, NULL, '2018-06-10 08:38:09', NULL),
(11, '5', 'EMP', 'Empresa', 'Empresa', 2, 1, NULL, '2018-06-10 08:37:23', NULL),
(12, '5', 'ADM', 'Administrativo', 'Administra', 3, 1, NULL, '2018-06-10 08:38:05', NULL),
(13, '6', 'AFP', 'AFP integra', 'AFP', 1, 1, NULL, '2018-06-10 08:39:35', NULL),
(14, '6', 'ONP', 'ONP', 'ONP', 2, 1, NULL, '2018-06-10 08:40:01', NULL),
(15, '7', '01', 'Jirón', 'Jirón', 1, 1, NULL, '2018-06-10 08:42:46', NULL),
(16, '7', '02', 'Av.', 'Avenida', 2, 1, NULL, '2018-06-10 08:43:08', NULL),
(17, '7', '03', 'Calle', 'Calle', 3, 1, NULL, '2018-06-10 08:43:29', NULL),
(18, '8', '01', 'Casa', 'Casa', 1, 1, NULL, '2018-06-10 08:43:55', NULL),
(19, '8', '02', 'Departamento', 'Dpto', 2, 1, NULL, '2018-06-10 08:44:28', NULL),
(20, '9', '01', '0-', '0-', 1, 1, NULL, '2018-06-10 08:48:01', NULL),
(21, '9', '02', '0+', '0+', 2, 1, NULL, '2018-06-10 08:48:24', NULL),
(22, '9', '03', 'A-', 'A-', 3, 1, NULL, '2018-06-10 08:48:47', NULL),
(23, '9', '04', 'A+', 'A+', 4, 1, NULL, '2018-06-10 08:49:59', NULL),
(24, '9', '05', 'B?', 'B?', 5, 1, NULL, '2018-06-10 08:50:22', NULL),
(25, '9', '06', 'B+', 'B+', 6, 1, NULL, '2018-06-10 08:50:43', NULL),
(26, '9', '07', 'AB?', 'AB?', 7, 1, NULL, '2018-06-10 08:51:03', NULL),
(27, '9', '08', 'AB+', 'AB+', 8, 1, NULL, '2018-06-10 08:51:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_parametro_tabla`
--

CREATE TABLE `gen_parametro_tabla` (
  `cc_parametro` varchar(10) NOT NULL,
  `cc_tabla` varchar(50) NOT NULL,
  `cc_campo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_parametro_tabla`
--

INSERT INTO `gen_parametro_tabla` (`cc_parametro`, `cc_tabla`, `cc_campo`) VALUES
('1', 'gen_personas', 'cod_documento'),
('2', 'gen_personas', 'cod_sexo'),
('3', 'gen_personas', 'e_civil'),
('4', 'gen_personas', 'afp_onp'),
('5', 'gen_personas', 'cod_tipo'),
('6', 'gen_personas', 'c_tipo_domicilio'),
('7', 'gen_personas', 'factor_sanguineo'),
('8', 'gen_personas', 'flag_activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas`
--

CREATE TABLE `gen_personas` (
  `cc_persona` int(10) NOT NULL,
  `fecha_de_registro` datetime DEFAULT NULL,
  `cod_tipo` varchar(50) DEFAULT NULL,
  `c_colegiado` varchar(50) DEFAULT NULL,
  `flag_habil` varchar(50) DEFAULT NULL,
  `abono_favor` decimal(10,2) DEFAULT NULL,
  `fecha_de_colegiacion` date DEFAULT NULL,
  `flag_activo` varchar(50) DEFAULT NULL,
  `cod_sexo` varchar(50) DEFAULT NULL,
  `apellido_Materno` varchar(50) DEFAULT NULL,
  `apellido_Paterno` varchar(50) DEFAULT NULL,
  `Nombre1` varchar(50) DEFAULT NULL,
  `Nombre2` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `pais_nacimiento` varchar(50) DEFAULT NULL,
  `coddpto_nacimiento` varchar(50) DEFAULT NULL,
  `codprov_nacimiento` varchar(50) DEFAULT NULL,
  `coddist_nacimiento` varchar(50) DEFAULT NULL,
  `cod_documento` varchar(50) DEFAULT NULL,
  `num_documento` varchar(50) DEFAULT NULL,
  `e_civil` varchar(50) DEFAULT NULL,
  `ruc` varchar(50) DEFAULT NULL,
  `afp_onp` varchar(50) DEFAULT NULL,
  `telefono1` varchar(50) DEFAULT NULL,
  `celular1` varchar(50) DEFAULT NULL,
  `celular2` varchar(50) DEFAULT NULL,
  `email1` varchar(50) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL,
  `c_local` varchar(50) DEFAULT NULL,
  `c_tipo_direc` varchar(50) DEFAULT NULL,
  `tipo_direccion` varchar(80) DEFAULT NULL,
  `c_tipo_domicilio` varchar(50) DEFAULT NULL,
  `tipo_domicilio` varchar(50) DEFAULT NULL,
  `coddpto` varchar(50) DEFAULT NULL,
  `codprov` varchar(50) DEFAULT NULL,
  `coddist` varchar(50) DEFAULT NULL,
  `factor_sanguineo` varchar(5) DEFAULT NULL,
  `fecha_de_cese` date DEFAULT NULL,
  `fecha_fallecido` date DEFAULT NULL,
  `c_entidad_pagadora` varchar(50) DEFAULT NULL,
  `c_sector_entidad_pagadora` varchar(50) DEFAULT NULL,
  `n_folio_cole` varchar(50) DEFAULT NULL,
  `n_libro_cole` varchar(50) DEFAULT NULL,
  `n_resolucion_cole` varchar(50) DEFAULT NULL,
  `flag` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_personas`
--

INSERT INTO `gen_personas` (`cc_persona`, `fecha_de_registro`, `cod_tipo`, `c_colegiado`, `flag_habil`, `abono_favor`, `fecha_de_colegiacion`, `flag_activo`, `cod_sexo`, `apellido_Materno`, `apellido_Paterno`, `Nombre1`, `Nombre2`, `nombre`, `fecha_nacimiento`, `pais_nacimiento`, `coddpto_nacimiento`, `codprov_nacimiento`, `coddist_nacimiento`, `cod_documento`, `num_documento`, `e_civil`, `ruc`, `afp_onp`, `telefono1`, `celular1`, `celular2`, `email1`, `email2`, `c_local`, `c_tipo_direc`, `tipo_direccion`, `c_tipo_domicilio`, `tipo_domicilio`, `coddpto`, `codprov`, `coddist`, `factor_sanguineo`, `fecha_de_cese`, `fecha_fallecido`, `c_entidad_pagadora`, `c_sector_entidad_pagadora`, `n_folio_cole`, `n_libro_cole`, `n_resolucion_cole`, `flag`) VALUES
(1, '2018-06-06 17:08:33', '1', '001210', NULL, NULL, NULL, NULL, NULL, 'Prete', 'Pretel', 'Manuel', NULL, 'Pretel Pretel Manuel', '2018-06-07', NULL, NULL, NULL, NULL, NULL, '40778180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(2, '2018-06-07 12:44:17', '1', '005112', NULL, NULL, NULL, NULL, NULL, 'De soto', 'Mayor', 'Renzo', NULL, 'De soto mayor Renzo', '2018-06-07', NULL, NULL, NULL, NULL, NULL, '40778185', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-07', '2018-06-07', NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas1`
--

CREATE TABLE `gen_personas1` (
  `cc_persona` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ct_fec_reg` datetime DEFAULT NULL,
  `ct_nombres` varchar(150) DEFAULT NULL,
  `ct_fech_nac` date DEFAULT NULL,
  `ct_est_civil` varchar(2) DEFAULT NULL,
  `ct_nro_doc` int(8) UNSIGNED ZEROFILL DEFAULT NULL,
  `cp_sexo` varchar(5) DEFAULT NULL,
  `ct_email` varchar(50) DEFAULT NULL,
  `ct_celular` varchar(50) DEFAULT NULL,
  `ct_direccion` varchar(250) DEFAULT NULL,
  `ct_obs` longtext,
  `ct_nombresc` varchar(200) DEFAULT NULL,
  `ct_emailc` varchar(100) DEFAULT NULL,
  `ct_celularc` varchar(20) DEFAULT NULL,
  `cfl_vigencia` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_personas1`
--

INSERT INTO `gen_personas1` (`cc_persona`, `ct_fec_reg`, `ct_nombres`, `ct_fech_nac`, `ct_est_civil`, `ct_nro_doc`, `cp_sexo`, `ct_email`, `ct_celular`, `ct_direccion`, `ct_obs`, `ct_nombresc`, `ct_emailc`, `ct_celularc`, `cfl_vigencia`) VALUES
(000001, '2017-03-12 10:20:08', 'MANUEL PRETEL', NULL, '01', 40778180, 'M', 'pretelll@hotmail.com', '999999999', 'RRR', '', '', '', '', 1),
(000004, '2017-10-28 09:09:43', 'CARRERA PRETEL EVERT', '1979-03-28', '01', 80359443, 'M', 'evertcarr@gmail.com', '976845373', 'Sausal', '', '', '', '', 1),
(000005, '2017-10-29 20:47:41', 'AGUILAR COTRINA ANTONIO', '2017-10-17', '01', 12345678, 'M', 'antonioag@1hotmail.com', '125487995', 'sausal', '', '', '', '', 1),
(000006, '2017-10-29 23:31:49', 'SAENZ MOSTACERO ANGEL', '2017-10-02', '01', 02530679, 'M', 'hhhhh@hotmail.com', '903658766', 'TRUJILLO', '', '', '', '', 1),
(000007, '2017-10-31 11:02:52', 'GONZALES CRUZADO DOMINGO', '2017-10-02', '05', 00000010, 'M', 'gdomingo@gmail.com', '932578995', 'Sausal', '', '', '', '', 1),
(000008, '2017-10-31 11:06:23', 'CARRERA LEON ANTONIO', '1959-08-22', '', 00000011, 'M', 'aleon@gmail.com', '955829355', 'quemazon', '', '', '', '', 1),
(000009, '2017-10-31 11:10:16', 'TERRONES AMAYA LUCIO', '2017-10-25', '', 00000012, 'M', 'iquintana@gmail.com', '986542789', 'panpas', '', '', '', '', 1),
(000010, '2017-10-31 11:24:23', 'TORRES CABADA YONEL', '2017-10-25', '05', 00000013, 'M', 'ytorres@gmail.com', '965423789', 'panpas', '', '', '', '', 1),
(000011, '2017-10-31 11:26:21', 'MENDOZA TERRONES HUMBERTO', '2017-10-26', '05', 00000014, 'M', 'tmendoza@gmail.com', '889546721', 'panpas', '', '', '', '', 1),
(000012, '2017-11-07 22:20:20', 'SANCHEZ CUZCO BASILIO', '2017-11-07', '05', 25307585, 'M', 'correo@gmail.com', '233366655', 'PUNTA MORENO', '', '', '', '', 1),
(000013, '2017-11-07 22:34:07', 'FLORES CALDERON ANGEL', '2017-11-08', '01', 02530677, 'M', 'correo@gmail.com', '999999999', 'sausal ', '', '', '', '', 1),
(000014, '2017-11-07 22:35:56', 'MOSTACERO ELMO ', '2017-11-07', '01', 04225828, 'M', 'correo@gmail.com', '458846987', 'SAUSAL', '', '', '', '982', 1),
(000015, '2017-11-09 16:53:11', 'PICHEN LEON HOMERO ', '2017-10-19', '01', 05268810, 'M', 'correo@gmail.com', '851279021', 'PAMPAS', '', '', '', '', 1),
(000016, '2017-11-09 16:55:02', 'PROSPERO  AGUILAR LEON ', '2017-10-19', '', 04599268, 'M', 'correo@gmail.com', '245876126', 'SAUSAL', '', '', '', '', 1),
(000017, '2017-11-09 16:56:23', 'CHAVEZ URIOL JULIO', '2017-10-19', '01', 85647924, 'M', 'correo@gmail.com', '321876542', 'sausal', '', '', '', '', 1),
(000018, '2017-11-09 16:58:26', 'BLAS LIGUENZA SANTOS', '2017-11-20', '', 85201346, 'F', 'correo@gmail.com', '325648823', 'sausal', '', '', '', '', 1),
(000019, '2017-11-12 23:11:13', 'AMAYA CASTILLO MAVILA ', NULL, '', 00000001, 'F', 'correo@gmail.com', '216842269', 'PAMPAS', '', '', '', '', 1),
(000020, '2017-11-12 23:22:25', 'SANCHEZ TIZNADO CARLOS', NULL, '', 00000022, 'M', 'correo@gmail.com', '000000012', 'SAUSAL', '', '', '', '', 1),
(000021, '2017-11-12 23:24:32', 'SERIN EDULAN', NULL, '', 03333378, 'M', 'correo@gmail.com', '999999998', 'CHALA', '', '', '', '', 1),
(000022, '2017-11-12 23:27:31', 'MENDOZA MOSTACERO AUCHE', NULL, '', 07777777, 'M', 'correo@gmail.com', '333333321', 'PAMPAS', '', '', '', '', 1),
(000023, '2017-11-12 23:32:03', 'MOSTACERO CHAVEZ JOSE ', NULL, '', 06666665, 'M', 'correo@gmail.com', '999999113', 'PAMPAS', '', '', '', '', 1),
(000024, '2017-11-12 23:33:45', 'PICHEN LEON HOMERO', NULL, '', 05555554, 'M', 'correo@gmail.com', '999824301', 'PAMPAS', '', '', '', '', 1),
(000025, '2017-11-12 23:35:31', 'AGUILAR LEON PROSPERO', NULL, '', 03332541, 'M', 'correo@gmail.com', '555522162', 'PAMPAS', '', '', '', '', 1),
(000026, '2017-11-12 23:37:54', 'CHAVEZ URIOL JULIO', NULL, '', 96790598, 'M', 'correo@gmail.com', '967905983', 'SAUSAL', '', '', '', '', 1),
(000027, '2017-11-12 23:40:22', 'AQUINO PIZARRO PEDRO', NULL, '', 08888821, 'M', 'pedro25275@hotmail.com', '949400326', 'SAUSAL', '', '', '', '', 1),
(000028, '2017-11-12 23:41:50', 'AVALOS MIRANDA BLANCA', NULL, '', 05555212, 'F', 'correo@gmail.com', '954444782', 'Sausal', '', '', '', '', 1),
(000029, '2017-11-12 23:45:45', 'MOSTACERO CAMACHO TERESA', NULL, '', 09887425, 'F', 'correo@gmail.com', '666666654', 'QUEMAZON', '', '', '', '', 1),
(000030, '2017-11-12 23:49:26', 'LEON DEZA ERVER', NULL, '', 02222215, 'M', 'correo@gmail.com', '999225583', 'Sausal', '', '', '', '', 1),
(000031, '2017-11-12 23:50:53', 'VALDEZ SILVA LUIS ', NULL, '', 03332211, 'M', 'correo@gmail.com', '222222220', 'Sausal', '', '', '', '', 1),
(000032, '2017-11-12 23:53:05', 'AMAYA JURADO CARLOS', NULL, '', 03333255, 'M', 'correo@gmail.com', '999850545', 'PAMPAS', '', '', '', '', 1),
(000033, '2017-11-12 23:54:04', 'MORA LEIVA JUAN', NULL, '', 09999885, 'M', 'correo@gmail.com', '111111548', 'Sausal', '', '', '', '', 1),
(000034, '2017-11-12 23:56:10', 'CUZCO LOJE SEBASTIAN', NULL, '', 06666554, 'M', 'correo@gmail.com', '332144522', 'QUEMAZON', '', '', '', '', 1),
(000035, '2017-11-12 23:58:52', 'AMAYA URIOL ANIBAL', NULL, '', 05555545, 'M', 'correo@gmail.com', '333225566', 'Sausal', '', '', '', '', 1),
(000036, '2017-11-13 00:00:24', 'AMAYA VARGAS CARLOS', NULL, '', 06665824, 'M', 'correo@gmail.com', '777777786', 'PAMPAS', '', '', '', '', 1),
(000037, '2017-11-13 00:03:28', 'IGLESIAS QUINTANA LUCIANO', NULL, '', 02222145, 'M', 'correo@gmail.com', '333332255', 'PAMPAS', '', '', '', '', 1),
(000038, '2017-11-13 00:06:45', 'CASTILLO MARQUINA SAMUEL', NULL, '', 06666654, 'M', 'correo@gmail.com', '665878245', 'QUEMAZON', '', '', '', '', 1),
(000039, '2017-11-13 00:09:28', 'GARCIA RODRIGUEZ GLADYS ', NULL, '', 06221110, 'F', 'correo@gmail.com', '555422222', 'Sausal', '', '', '', '', 1),
(000040, '2017-11-13 00:10:29', 'VILLA RAFAEL DEYSI', NULL, '', 03332600, 'F', 'correo@gmail.com', '222235544', 'PAMPAS', '', '', '', '', 1),
(000041, '2017-11-13 00:11:21', 'RENGIFO LUCANO', NULL, '', 08888972, 'M', 'correo@gmail.com', '888444458', 'Sausal', '', '', '', '', 1),
(000042, '2017-11-13 00:12:31', 'RUIZ SALVADOR LUIS', NULL, '', 07771115, 'M', 'correo@gmail.com', '998852225', 'Sausal', '', '', '', '', 1),
(000043, '2017-11-13 00:13:30', 'CARRERA LEON PATROCINIO', NULL, '', 05555889, 'M', 'correo@gmail.com', '999988222', 'TESORO', '', '', '', '', 1),
(000044, '2017-11-13 00:14:35', 'ARGOMEDO RAFAEL JEREMIAS ', NULL, '', 08888221, 'M', 'correo@gmail.com', '888222365', 'Sausal', '', '', '', '', 1),
(000045, '2017-11-13 00:15:29', 'CHAVEZ MATUTE MIGUEL', NULL, '', 04444712, 'M', 'correo@gmail.com', '777774444', 'Sausal', '', '', '', '', 1),
(000046, '2017-11-13 00:16:39', 'MOSTACERO CHAVEZ JOSE ', NULL, '', 06655542, 'M', 'correo@gmail.com', '999998752', 'Sausal', '', '', '', '', 1),
(000047, '2017-11-13 00:17:45', 'LOPEZ PLACENCIA FREDY', NULL, '', 05555555, 'M', 'correo@gmail.com', '555555544', 'Sausal', '', '', '', '', 1),
(000048, '2017-11-13 00:19:26', 'AGUILAR GALLARDO JESUS', NULL, '', 06666655, 'M', 'correo@gmail.com', '000000022', 'Sausal', '', '', '', '', 1),
(000049, '2017-11-13 00:20:41', 'OBANDO ALCANTARA AGUSTIN', NULL, '', 06665554, 'M', 'correo@gmail.com', '999988852', 'TESORO', '', '', '', '', 1),
(000050, '2017-11-13 00:22:27', 'LEON CASTILLO AUSBATO', NULL, '', 03333332, 'M', 'correo@gmail.com', '555555555', 'PAMPAS', '', '', '', '', 1),
(000051, '2017-11-20 09:49:08', 'NAMOC MOSTACERO URIAS', NULL, '01', 99999999, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000052, '2017-11-20 10:44:01', 'CARRERA PRETEL WILLIAM', '2000-11-08', '01', 70224444, 'M', 'antonioag@1hotmail.com', '555555555', 'sausal', '', '', '', '', 1),
(000053, '2017-11-20 10:46:52', 'RAMIREZ VELASQUEZ ROGER', '1988-10-31', '01', 70222222, 'F', 'antonioag@1hotmail.com', '888888888', 'sausal', '', '', '', '', 1),
(000054, '2017-11-20 10:47:59', 'CASTILLO MARROQUIN LUIS GUILLERMO', '2000-11-08', '01', 88888888, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000055, '2017-11-20 10:48:51', 'LEON DEZA ERMES', '2000-11-07', '01', 07777770, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 0),
(000056, '2017-11-20 10:50:51', 'MEDINA PICHEN SAMUEL', NULL, '01', 00000025, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000057, '2017-11-20 10:53:37', 'DIAZ LEON ELMER', '2010-11-07', '02', 02530678, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000058, '2017-11-20 10:54:41', 'CHIGNE PEREZ BERNARDO', '2000-10-30', '02', 02530672, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000059, '2017-11-20 10:55:16', 'MONZON ACUÑA ROGER', '2010-10-02', '01', 02530671, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000060, '2017-11-20 10:55:48', 'BLAS GUEVARA EUSEBIO', NULL, '01', 04225820, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1),
(000061, '2017-11-20 10:56:36', 'CARRERA  PUCHEN ELIAS', NULL, '02', 00000002, 'M', 'antonioag@1hotmail.com', '976845373', 'sausal', '', '', '', '', 1),
(000062, '2017-11-20 10:59:15', 'DE LA CRUZ ELEUTERIO ', NULL, '01', 00000015, 'M', 'antonioag@1hotmail.com', '976845373', 'sausal', '', '', '', '', 1),
(000063, '2017-11-20 11:30:57', 'MEDINA DIAZ CESAR MANUEL', NULL, '01', 07777888, 'M', 'antonioag@1hotmail.com', '955829355', 'sausal', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_actividades`
--

CREATE TABLE `gen_personas_actividades` (
  `cc_actividad` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `preferencia` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_colegiado`
--

CREATE TABLE `gen_personas_colegiado` (
  `cc_colegio` int(11) NOT NULL,
  `fecha_regis` int(11) NOT NULL,
  `num_colegio` int(11) NOT NULL,
  `fecha_registro_colegiado` date NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_diplomas`
--

CREATE TABLE `gen_personas_diplomas` (
  `cc_diplomas` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `cc_personas` varchar(10) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `denominacion` varchar(150) NOT NULL,
  `especialidad` varchar(150) NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `numero_registro` varchar(10) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_especialidad`
--

CREATE TABLE `gen_personas_especialidad` (
  `cc_especialidad` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_experiencia` varchar(2) NOT NULL,
  `sector` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_estudios`
--

CREATE TABLE `gen_personas_estudios` (
  `cc_estudios` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `cc_personas` varchar(10) NOT NULL,
  `cc_facultad` int(10) NOT NULL,
  `grado` varchar(5) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_familiar`
--

CREATE TABLE `gen_personas_familiar` (
  `cc_familiar` int(10) DEFAULT NULL,
  `cc_persona` int(10) DEFAULT NULL,
  `fec_registro` datetime DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `fec_nacimiento` date DEFAULT NULL,
  `parentesco` varchar(2) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_organizaciones`
--

CREATE TABLE `gen_personas_organizaciones` (
  `cc_empresas` varchar(10) NOT NULL,
  `cc_personas` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_personas_trabajos`
--

CREATE TABLE `gen_personas_trabajos` (
  `cc_trabajos` int(11) DEFAULT NULL,
  `cc_personas` int(11) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tipo_empleado` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_modulo`
--

CREATE TABLE `seg_modulo` (
  `mod_id1` varchar(10) NOT NULL,
  `mod_id2` varchar(10) NOT NULL DEFAULT '',
  `mod_id3` varchar(10) NOT NULL DEFAULT '',
  `mod_nombre` varchar(50) DEFAULT NULL,
  `mod_nivel` varchar(10) DEFAULT NULL,
  `mod_carpeta` varchar(50) DEFAULT NULL,
  `mod_url` varchar(50) DEFAULT NULL,
  `mod_img` varchar(50) DEFAULT NULL,
  `mod_js` varchar(50) DEFAULT NULL,
  `mod_estado` varchar(2) DEFAULT NULL,
  `mod_orden` int(11) DEFAULT NULL,
  `mod_ico` varchar(50) DEFAULT NULL,
  `mod_tipo` varchar(5) DEFAULT NULL,
  `mod_tipo_user` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_modulo`
--

INSERT INTO `seg_modulo` (`mod_id1`, `mod_id2`, `mod_id3`, `mod_nombre`, `mod_nivel`, `mod_carpeta`, `mod_url`, `mod_img`, `mod_js`, `mod_estado`, `mod_orden`, `mod_ico`, `mod_tipo`, `mod_tipo_user`) VALUES
('10', '00', '00', 'Configuracion', '1', '../seguridad/', NULL, NULL, NULL, '1', 1, 'fa-cogs', 'priv', NULL),
('10', '10', '00', 'Accesos', '2', '../seguridad/', NULL, NULL, NULL, '1', 1, '', 'priv', NULL),
('10', '10', '01', 'Perfil', '3', '../seguridad/', 'per_index.php', NULL, 'jperfil.js', '1', 1, '', 'priv', NULL),
('10', '10', '02', 'Accesos a perfiles', '3', '../seguridad/', 'acc_index.php', NULL, 'jacceso.js', '1', 2, '', 'priv', NULL),
('10', '10', '03', 'Usuarios', '3', '../seguridad/', 'usu_index.php', NULL, 'jusuario.js', '1', 3, NULL, 'priv', NULL),
('10', '10', '04', 'Entidad', '3', '../seguridad/', 'ent_index.php', NULL, 'jentidad.js', '1', 4, NULL, NULL, NULL),
('10', '11', '00', 'Mantenimiento', '2', '../datos_generales/', NULL, NULL, NULL, '1', 2, NULL, NULL, NULL),
('10', '11', '04', 'Conceptos', '3', '../datos_generales/', 'con_index.php', NULL, 'jconceptos.js', '1', 4, NULL, 'priv', NULL),
('10', '11', '05', 'Periodo', '3', '../datos_generales/', 'perio_index.php', NULL, 'jperiodo.js', '1', 5, NULL, 'priv', NULL),
('21', '00', '00', 'Caja', '1', '../caja/', NULL, NULL, NULL, '1', 21, 'fa-recycle', 'priv', NULL),
('21', '01', '00', 'Operaciones         ', '2', '../caja/', NULL, NULL, NULL, '1', 1, NULL, 'priv', NULL),
('21', '01', '01', 'Punto de Venta', '3', '../caja/', 'ptov_index.php', NULL, 'jptoventa.js', '1', 1, NULL, 'priv', NULL),
('21', '01', '02', 'Nuevo(Recibo)', '3', '../caja/', 'caj_registro.php', NULL, 'jcaja.js', '1', 2, NULL, 'priv', NULL),
('21', '01', '03', 'Pago Anual', '3', '../caja/', 'pago_anual_index.php', NULL, 'jpago_anual.js', '1', 3, NULL, 'priv', NULL),
('21', '01', '04', 'Procesar Recaudadora', '3', '../caja/', 'recaudo_procesar_index.php', NULL, 'jrecaudo_procesar.js', '1', 4, NULL, 'priv', NULL),
('21', '02', '00', 'Reportes            ', '2', '../caja/', NULL, NULL, NULL, '1', 2, NULL, 'priv', NULL),
('21', '02', '01', 'Estado de Cuenta', '3', '../caja/', 'estado_cuenta_index.php', NULL, 'jestado_cuenta.js', '1', 1, NULL, 'priv', NULL),
('21', '02', '02', 'Recaudadora', '3', '../caja/', 'recaudo_repor_index.php', NULL, 'jrecaudo_reporte.js', '1', 3, NULL, 'priv', NULL),
('21', '02', '03', 'Historial Abonos', '3', '../caja/', 'historial_abonos_index.php', NULL, 'jhistorial_abonos.js', '1', 3, NULL, 'priv', NULL),
('21', '02', '07', 'Listar Documentos', '3', '../caja/', 'caj_index.php', NULL, 'jcaja_buscar.js', '1', 8, NULL, 'priv', NULL),
('21', '02', '08', 'Buscar Voucher', '3', '../caja/', 'buscar_voucher_index.php', NULL, 'jbuscar_voucher.js', '1', 9, NULL, 'priv', NULL),
('21', '02', '09', 'Abonos Recaudadora', '3', '../caja/', 'recaudadora_a_index.php', NULL, 'jrecaudadora_a.js', '1', 2, NULL, 'priv', NULL),
('21', '03', '00', 'Utiles              ', '2', '../caja/', NULL, NULL, NULL, '1', 3, NULL, 'priv', NULL),
('21', '04', '00', 'Ayuda               ', '2', '../caja/', NULL, NULL, NULL, '1', 4, NULL, 'priv', NULL),
('21', '04', '01', 'prueba', '3', '../prueba/', 'index.php', NULL, 'jprueba.js', '1', 1, NULL, 'priv', NULL),
('22', '00', '00', 'Colegiatura', '1', '../colegiatura/', NULL, NULL, NULL, '1', 22, 'fa-recycle', 'priv', NULL),
('22', '01', '00', 'Operaciones', '2', '../colegiatura/', NULL, NULL, NULL, '1', 1, NULL, 'priv', NULL),
('22', '01', '01', 'Colegiado', '3', '../colegiatura/', 'colegiado_index.php', NULL, 'jcolegiado.js', '1', 1, NULL, 'priv', NULL),
('22', '01', '02', 'Pre-Matricula', '3', '../colegiatura/', 'pre_matricula_index.php', NULL, 'jpre_matricula.js', '1', 2, NULL, 'priv', NULL),
('22', '02', '00', 'Reportes', '2', '../colegiatura/', NULL, NULL, NULL, '1', 2, NULL, 'priv', NULL),
('22', '02', '01', 'Reporte1', '3', '../colegiatura/', 'reporte1_index.php', NULL, 'jreporte1.js', '1', 1, NULL, 'priv', NULL),
('22', '02', '02', 'Reporte2', '3', '../colegiatura/', 'reporte2_index.php', NULL, 'jreporte1.js', '1', 2, NULL, 'priv', NULL),
('22', '02', '03', 'Reporte3', '3', '../colegiatura/', 'reporte3_index.php', NULL, 'jreporte3.js', '1', 2, NULL, 'priv', NULL),
('22', '03', '00', 'Ayuda', '2', '../colegiatura/', NULL, NULL, NULL, '1', 3, NULL, 'priv', NULL),
('23', '00', '00', 'Trámites', '1', '../tramites /', NULL, NULL, NULL, '1', 23, 'fa-recycle', 'priv', NULL),
('23', '01', '00', 'Operaciones', '2', '../tramites/', NULL, NULL, NULL, '1', 1, NULL, 'priv', NULL),
('23', '01', '01', 'Habilitación', '3', '../tramites/', 'habilitacion_index.php', NULL, 'jhabilitacion.js', '1', 1, NULL, 'priv', NULL),
('23', '02', '00', 'Reportes', '2', '../tramites/', NULL, NULL, NULL, '1', 2, NULL, 'priv', NULL),
('23', '03', '00', 'Ayuda', '2', '../tramites/', NULL, NULL, NULL, '1', 3, NULL, 'priv', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_modulo1`
--

CREATE TABLE `seg_modulo1` (
  `cc_modulo` int(11) NOT NULL,
  `cc_padre` int(11) DEFAULT '0',
  `cc_hijo` int(11) DEFAULT '0',
  `ct_modulo` varchar(50) DEFAULT NULL,
  `nn_nivel` int(3) DEFAULT NULL,
  `ct_carpeta` varchar(50) DEFAULT NULL,
  `ct_url` varchar(50) DEFAULT NULL,
  `ct_img` varchar(50) DEFAULT NULL,
  `ct_js` varchar(50) DEFAULT NULL,
  `nn_orden` int(11) DEFAULT '0',
  `ct_clase_cuerpo` varchar(40) DEFAULT NULL,
  `cfl_acceso` int(2) UNSIGNED DEFAULT NULL COMMENT '0: restringido,1 publico',
  `cfl_vigencia` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_modulo1`
--

INSERT INTO `seg_modulo1` (`cc_modulo`, `cc_padre`, `cc_hijo`, `ct_modulo`, `nn_nivel`, `ct_carpeta`, `ct_url`, `ct_img`, `ct_js`, `nn_orden`, `ct_clase_cuerpo`, `cfl_acceso`, `cfl_vigencia`) VALUES
(1, 0, 0, 'Administrar accesos', 0, NULL, NULL, NULL, NULL, 1, 'container', 0, 1),
(2, 1, 0, 'Usuarios', 1, '../seguridad/', 'usu_index.php', NULL, 'jusuario.js', 3, 'container', 0, 1),
(3, 1, 0, 'accesos a perfil', 1, '../seguridad/', 'acc_index.php', NULL, 'jacceso.js', 2, 'container-fluid', 1, 1),
(4, 1, 0, 'Perfil', 1, '../seguridad/', 'per_index.php', NULL, 'jperfil.js', 1, 'container', 0, 1),
(5, 0, 0, 'Mantenimiento', 0, NULL, NULL, NULL, NULL, 2, NULL, 0, 1),
(6, 5, 0, 'Clientes', 1, '../datos_generales/', 'per_index.php', NULL, 'jempleado.js', 1, 'container-fluid', 0, 1),
(8, 0, 0, 'Facturación', 0, '', '', NULL, NULL, 5, NULL, 0, 1),
(9, 8, 0, 'Nueva venta', 1, '../caja/', 'caj_index.php', NULL, 'jcaja.js', 1, 'container', 0, 1),
(10, 0, 0, 'Reportes', 0, '', '', NULL, '', 6, NULL, 0, 1),
(12, 0, 0, 'Compras', 0, NULL, NULL, NULL, NULL, 4, NULL, 0, 1),
(13, 12, 0, 'Nueva compra', 1, '../compras/', 'comp_index.php', NULL, 'jcompras.js', 1, 'container', 0, 1),
(15, 8, 0, 'Administrar documentos', 1, '../caja/', 'rcb_index.php', NULL, 'jrecibos.js', 2, 'container', 0, 1),
(16, 5, 0, 'Proveedores', 1, '../datos_generales/', 'emp_index.php', NULL, 'jempresa.js', 3, 'container', 0, 1),
(17, 0, 0, 'Almacen', 0, NULL, NULL, NULL, NULL, 3, NULL, 0, 1),
(18, 17, 0, 'Registro', 1, '../almacen/', 'alm_index.php', NULL, 'jalmacen.js', 1, 'container', 0, 1),
(21, 10, 0, 'Reporte de ventas', 1, '../reportes/', 'ven_index.php', NULL, 'jventas.js', 2, 'container', 0, 1),
(22, 10, 0, 'Reporte de inventario', 1, '../reportes/', 'egr_index.php', NULL, 'jegresos.js', 3, 'container', 0, 1),
(24, 10, 0, 'Reporte de compras', 1, '../reportes/', 'asob_index.php', NULL, 'jasobalance.js', 4, 'container', 0, 1),
(25, 5, 0, 'Articulo', 1, '../datos_generales/', 'art_index.php', NULL, 'jarticulo.js', 3, 'container-fluid', 0, 1),
(26, 12, 0, 'Historial de compras', 1, '../compras/', 'hist_index.php', NULL, 'jhistorial.js', 2, 'container-fluid', 0, 1),
(27, 10, 0, 'Ganacias y pérdidas', 1, '../reportes/', 'gan_index.php', NULL, 'jganancias.js', 1, 'container-fluid', 0, 1),
(28, 10, 0, 'Reporte de precios', 1, '../reportes/', 'pre_index.php', NULL, 'jprecios.js', 3, 'container', 0, 1),
(29, 8, 0, 'Estado de cuenta', 1, '../datos_generales/', 'deu_index.php', NULL, 'jdeuda.js', 3, 'container', 0, 1),
(31, 1, 0, 'Usuarios', 1, NULL, NULL, NULL, NULL, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_modulo_perfil`
--

CREATE TABLE `seg_modulo_perfil` (
  `cc_modulo` int(11) NOT NULL,
  `cc_perfil` int(11) NOT NULL,
  `cc_usuario_audit` int(11) DEFAULT NULL,
  `df_log` datetime DEFAULT NULL,
  `ct_ip` varchar(20) DEFAULT NULL COMMENT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_modulo_perfil`
--

INSERT INTO `seg_modulo_perfil` (`cc_modulo`, `cc_perfil`, `cc_usuario_audit`, `df_log`, `ct_ip`) VALUES
(101001, 2, 1, '2018-05-20 16:42:20', '1'),
(101005, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210101, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210102, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210103, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210104, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210201, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210209, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210202, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210203, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210207, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210208, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(210401, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(220101, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(220102, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(220201, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(220202, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(220203, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(230101, 3, 1, '2018-06-05 18:29:08', '192.168.88.9'),
(0, 5, 1, '2018-06-12 23:30:43', '::1'),
(0, 5, 1, '2018-06-12 23:30:43', '::1'),
(101001, 4, 1, '2018-06-12 23:36:02', '::1'),
(101002, 4, 1, '2018-06-12 23:36:02', '::1'),
(101003, 4, 1, '2018-06-12 23:36:02', '::1'),
(101004, 4, 1, '2018-06-12 23:36:02', '::1'),
(101104, 4, 1, '2018-06-12 23:36:02', '::1'),
(101105, 4, 1, '2018-06-12 23:36:02', '::1'),
(210401, 4, 1, '2018-06-12 23:36:02', '::1'),
(101001, 1, 1, '2018-06-13 08:31:21', '::1'),
(101002, 1, 1, '2018-06-13 08:31:21', '::1'),
(101003, 1, 1, '2018-06-13 08:31:21', '::1'),
(101004, 1, 1, '2018-06-13 08:31:21', '::1'),
(101104, 1, 1, '2018-06-13 08:31:21', '::1'),
(101105, 1, 1, '2018-06-13 08:31:21', '::1'),
(210101, 1, 1, '2018-06-13 08:31:21', '::1'),
(210102, 1, 1, '2018-06-13 08:31:21', '::1'),
(210201, 1, 1, '2018-06-13 08:31:21', '::1'),
(210209, 1, 1, '2018-06-13 08:31:21', '::1'),
(210202, 1, 1, '2018-06-13 08:31:21', '::1'),
(210203, 1, 1, '2018-06-13 08:31:21', '::1'),
(210207, 1, 1, '2018-06-13 08:31:21', '::1'),
(210208, 1, 1, '2018-06-13 08:31:21', '::1'),
(210401, 1, 1, '2018-06-13 08:31:21', '::1'),
(220101, 1, 1, '2018-06-13 08:31:21', '::1'),
(220102, 1, 1, '2018-06-13 08:31:21', '::1'),
(230101, 1, 1, '2018-06-13 08:31:21', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_pagina`
--

CREATE TABLE `seg_pagina` (
  `cc_pagina` int(11) NOT NULL,
  `ct_pagina` varchar(50) DEFAULT NULL,
  `ct_url` varchar(100) DEFAULT NULL,
  `ct_js` varchar(50) DEFAULT NULL,
  `ct_clase_cuerpo` varchar(40) DEFAULT NULL,
  `cfl_vigencia` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_perfil`
--

CREATE TABLE `seg_perfil` (
  `cc_perfil` int(11) NOT NULL,
  `ct_perfil` varchar(50) DEFAULT NULL,
  `cc_modulo_defecto` int(11) DEFAULT NULL COMMENT 'Cuando ingresar a Sistema por defecto que pagina se va mostrar',
  `cfl_vigencia` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_perfil`
--

INSERT INTO `seg_perfil` (`cc_perfil`, `ct_perfil`, `cc_modulo_defecto`, `cfl_vigencia`) VALUES
(1, 'Administrador', 101003, 1),
(3, 'Cajero', 210202, 1),
(4, 'Asistente', 210104, 1),
(5, 'wwww', 101004, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_usuario`
--

CREATE TABLE `seg_usuario` (
  `cc_usuario` varchar(10) NOT NULL,
  `cc_user` varchar(45) NOT NULL,
  `cc_perfil` int(11) NOT NULL,
  `ct_clave` varchar(45) DEFAULT NULL,
  `nn_tiempo_sesion` int(11) DEFAULT '0',
  `cp_nivel` varchar(5) DEFAULT NULL,
  `cfl_acceso` int(2) UNSIGNED DEFAULT NULL COMMENT '0:sin acceso,1:con acceso',
  `df_caduca` date DEFAULT NULL COMMENT 'cuando acduca su clave',
  `cfl_clave_cambia` int(2) UNSIGNED DEFAULT NULL COMMENT '0: necesita cambiar clave, 1: clave cambiado',
  `cc_usuario_audit` varchar(10) DEFAULT NULL,
  `df_log` datetime DEFAULT NULL,
  `ct_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_usuario`
--

INSERT INTO `seg_usuario` (`cc_usuario`, `cc_user`, `cc_perfil`, `ct_clave`, `nn_tiempo_sesion`, `cp_nivel`, `cfl_acceso`, `df_caduca`, `cfl_clave_cambia`, `cc_usuario_audit`, `df_log`, `ct_ip`) VALUES
('000001', 'admin', 1, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3600, '', 1, '2019-06-05', 1, '000001', '2018-06-05 11:39:38', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE `ubigeo` (
  `cc_departamento` char(2) NOT NULL,
  `provincia` char(2) DEFAULT NULL,
  `distrito` char(2) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubigeo`
--

INSERT INTO `ubigeo` (`cc_departamento`, `provincia`, `distrito`, `nombre`) VALUES
('01', '00', '00', 'AMAZONAS'),
('01', '01', '00', 'CHACHAPOYAS'),
('01', '01', '01', 'CHACHAPOYAS'),
('01', '01', '02', 'ASUNCION'),
('01', '01', '03', 'BALSAS'),
('01', '01', '04', 'CHETO'),
('01', '01', '05', 'CHILIQUIN'),
('01', '01', '06', 'CHUQUIBAMBA'),
('01', '01', '07', 'GRANADA'),
('01', '01', '08', 'HUANCAS'),
('01', '01', '09', 'LA JALCA'),
('01', '01', '10', 'LEIMEBAMBA'),
('01', '01', '11', 'LEVANTO'),
('01', '01', '12', 'MAGDALENA'),
('01', '01', '13', 'MARISCAL CASTILLA'),
('01', '01', '14', 'MOLINOPAMPA'),
('01', '01', '15', 'MONTEVIDEO'),
('01', '01', '16', 'OLLEROS'),
('01', '01', '17', 'QUINJALCA'),
('01', '01', '18', 'SAN FRANCISCO DE DAGUAS'),
('01', '01', '19', 'SAN ISIDRO DE MAINO'),
('01', '01', '20', 'SOLOCO'),
('01', '01', '21', 'SONCHE'),
('01', '02', '00', 'BAGUA'),
('01', '02', '01', 'LA PECA'),
('01', '02', '02', 'ARAMANGO'),
('01', '02', '03', 'COPALLIN'),
('01', '02', '04', 'EL PARCO'),
('01', '02', '05', 'BAGUA'),
('01', '02', '06', 'IMAZA'),
('01', '03', '00', 'BONGARA'),
('01', '03', '01', 'JUMBILLA'),
('01', '03', '02', 'COROSHA'),
('01', '03', '03', 'CUISPES'),
('01', '03', '04', 'CHISQUILLA'),
('01', '03', '05', 'CHURUJA'),
('01', '03', '06', 'FLORIDA'),
('01', '03', '07', 'RECTA'),
('01', '03', '08', 'SAN CARLOS'),
('01', '03', '09', 'SHIPASBAMBA'),
('01', '03', '10', 'VALERA'),
('01', '03', '11', 'YAMBRASBAMBA'),
('01', '03', '12', 'JAZAN'),
('01', '04', '00', 'LUYA'),
('01', '04', '01', 'LAMUD'),
('01', '04', '02', 'CAMPORREDONDO'),
('01', '04', '03', 'COCABAMBA'),
('01', '04', '04', 'COLCAMAR'),
('01', '04', '05', 'CONILA'),
('01', '04', '06', 'INGUILPATA'),
('01', '04', '07', 'LONGUITA'),
('01', '04', '08', 'LONYA CHICO'),
('01', '04', '09', 'LUYA'),
('01', '04', '10', 'LUYA VIEJO'),
('01', '04', '11', 'MARIA'),
('01', '04', '12', 'OCALLI'),
('01', '04', '13', 'OCUMAL'),
('01', '04', '14', 'PISUQUIA'),
('01', '04', '15', 'SAN CRISTOBAL'),
('01', '04', '16', 'SAN FRANCISCO DE YESO'),
('01', '04', '17', 'SAN JERONIMO'),
('01', '04', '18', 'SAN JUAN DE LOPECANCHA'),
('01', '04', '19', 'SANTA CATALINA'),
('01', '04', '20', 'SANTO TOMAS'),
('01', '04', '21', 'TINGO'),
('01', '04', '22', 'TRITA'),
('01', '04', '23', 'PROVIDENCIA'),
('01', '05', '00', 'RODRIGUEZ DE MENDOZA'),
('01', '05', '01', 'SAN NICOLAS'),
('01', '05', '02', 'COCHAMAL'),
('01', '05', '03', 'CHIRIMOTO'),
('01', '05', '04', 'HUAMBO'),
('01', '05', '05', 'LIMABAMBA'),
('01', '05', '06', 'LONGAR'),
('01', '05', '07', 'MILPUCC'),
('01', '05', '08', 'MARISCAL BENAVIDES'),
('01', '05', '09', 'OMIA'),
('01', '05', '10', 'SANTA ROSA'),
('01', '05', '11', 'TOTORA'),
('01', '05', '12', 'VISTA ALEGRE'),
('01', '06', '00', 'CONDORCANQUI'),
('01', '06', '01', 'NIEVA'),
('01', '06', '02', 'RIO SANTIAGO'),
('01', '06', '03', 'EL CENEPA'),
('01', '07', '00', 'UTCUBAMBA'),
('01', '07', '01', 'BAGUA GRANDE'),
('01', '07', '02', 'CAJARURO'),
('01', '07', '03', 'CUMBA'),
('01', '07', '04', 'EL MILAGRO'),
('01', '07', '05', 'JAMALCA'),
('01', '07', '06', 'LONYA GRANDE'),
('01', '07', '07', 'YAMON'),
('02', '00', '00', 'ANCASH'),
('02', '01', '00', 'HUARAZ'),
('02', '01', '01', 'HUARAZ'),
('02', '01', '02', 'INDEPENDENCIA'),
('02', '01', '03', 'COCHABAMBA'),
('02', '01', '04', 'COLCABAMBA'),
('02', '01', '05', 'HUANCHAY'),
('02', '01', '06', 'JANGAS'),
('02', '01', '07', 'LA LIBERTAD'),
('02', '01', '08', 'OLLEROS'),
('02', '01', '09', 'PAMPAS GRANDE'),
('02', '01', '10', 'PARIACOTO'),
('02', '01', '11', 'PIRA'),
('02', '01', '12', 'TARICA'),
('02', '02', '00', 'AIJA'),
('02', '02', '01', 'AIJA'),
('02', '02', '03', 'CORIS'),
('02', '02', '05', 'HUACLLAN'),
('02', '02', '06', 'LA MERCED'),
('02', '02', '08', 'SUCCHA'),
('02', '03', '00', 'BOLOGNESI'),
('02', '03', '01', 'CHIQUIAN'),
('02', '03', '02', 'ABELARDO PARDO LEZAMETA'),
('02', '03', '04', 'AQUIA'),
('02', '03', '05', 'CAJACAY'),
('02', '03', '10', 'HUAYLLACAYAN'),
('02', '03', '11', 'HUASTA'),
('02', '03', '13', 'MANGAS'),
('02', '03', '15', 'PACLLON'),
('02', '03', '17', 'SAN MIGUEL DE CORPANQUI'),
('02', '03', '20', 'TICLLOS'),
('02', '03', '21', 'ANTONIO RAIMONDI'),
('02', '03', '22', 'CANIS'),
('02', '03', '23', 'COLQUIOC'),
('02', '03', '24', 'LA PRIMAVERA'),
('02', '03', '25', 'HUALLANCA'),
('02', '04', '00', 'CARHUAZ'),
('02', '04', '01', 'CARHUAZ'),
('02', '04', '02', 'ACOPAMPA'),
('02', '04', '03', 'AMASHCA'),
('02', '04', '04', 'ANTA'),
('02', '04', '05', 'ATAQUERO'),
('02', '04', '06', 'MARCARA'),
('02', '04', '07', 'PARIAHUANCA'),
('02', '04', '08', 'SAN MIGUEL DE ACO'),
('02', '04', '09', 'SHILLA'),
('02', '04', '10', 'TINCO'),
('02', '04', '11', 'YUNGAR'),
('02', '05', '00', 'CASMA'),
('02', '05', '01', 'CASMA'),
('02', '05', '02', 'BUENA VISTA ALTA'),
('02', '05', '03', 'COMANDANTE NOEL'),
('02', '05', '05', 'YAUTAN'),
('02', '06', '00', 'CORONGO'),
('02', '06', '01', 'CORONGO'),
('02', '06', '02', 'ACO'),
('02', '06', '03', 'BAMBAS'),
('02', '06', '04', 'CUSCA'),
('02', '06', '05', 'LA PAMPA'),
('02', '06', '06', 'YANAC'),
('02', '06', '07', 'YUPAN'),
('02', '07', '00', 'HUAYLAS'),
('02', '07', '01', 'CARAZ'),
('02', '07', '02', 'HUALLANCA'),
('02', '07', '03', 'HUATA'),
('02', '07', '04', 'HUAYLAS'),
('02', '07', '05', 'MATO'),
('02', '07', '06', 'PAMPAROMAS'),
('02', '07', '07', 'PUEBLO LIBRE'),
('02', '07', '08', 'SANTA CRUZ'),
('02', '07', '09', 'YURACMARCA'),
('02', '07', '10', 'SANTO TORIBIO'),
('02', '08', '00', 'HUARI'),
('02', '08', '01', 'HUARI'),
('02', '08', '02', 'CAJAY'),
('02', '08', '03', 'CHAVIN DE HUANTAR'),
('02', '08', '04', 'HUACACHI'),
('02', '08', '05', 'HUACHIS'),
('02', '08', '06', 'HUACCHIS'),
('02', '08', '07', 'HUANTAR'),
('02', '08', '08', 'MASIN'),
('02', '08', '09', 'PAUCAS'),
('02', '08', '10', 'PONTO'),
('02', '08', '11', 'RAHUAPAMPA'),
('02', '08', '12', 'RAPAYAN'),
('02', '08', '13', 'SAN MARCOS'),
('02', '08', '14', 'SAN PEDRO DE CHANA'),
('02', '08', '15', 'UCO'),
('02', '08', '16', 'ANRA'),
('02', '09', '00', 'MARISCAL LUZURIAGA'),
('02', '09', '01', 'PISCOBAMBA'),
('02', '09', '02', 'CASCA'),
('02', '09', '03', 'LUCMA'),
('02', '09', '04', 'FIDEL OLIVAS ESCUDERO'),
('02', '09', '05', 'LLAMA'),
('02', '09', '06', 'LLUMPA'),
('02', '09', '07', 'MUSGA'),
('02', '09', '08', 'ELEAZAR GUZMAN BARRON'),
('02', '10', '00', 'PALLASCA'),
('02', '10', '01', 'CABANA'),
('02', '10', '02', 'BOLOGNESI'),
('02', '10', '03', 'CONCHUCOS'),
('02', '10', '04', 'HUACASCHUQUE'),
('02', '10', '05', 'HUANDOVAL'),
('02', '10', '06', 'LACABAMBA'),
('02', '10', '07', 'LLAPO'),
('02', '10', '08', 'PALLASCA'),
('02', '10', '09', 'PAMPAS'),
('02', '10', '10', 'SANTA ROSA'),
('02', '10', '11', 'TAUCA'),
('02', '11', '00', 'POMABAMBA'),
('02', '11', '01', 'POMABAMBA'),
('02', '11', '02', 'HUAYLLAN'),
('02', '11', '03', 'PAROBAMBA'),
('02', '11', '04', 'QUINUABAMBA'),
('02', '12', '00', 'RECUAY'),
('02', '12', '01', 'RECUAY'),
('02', '12', '02', 'COTAPARACO'),
('02', '12', '03', 'HUAYLLAPAMPA'),
('02', '12', '04', 'MARCA'),
('02', '12', '05', 'PAMPAS CHICO'),
('02', '12', '06', 'PARARIN'),
('02', '12', '07', 'TAPACOCHA'),
('02', '12', '08', 'TICAPAMPA'),
('02', '12', '09', 'LLACLLIN'),
('02', '12', '10', 'CATAC'),
('02', '13', '00', 'SANTA'),
('02', '13', '01', 'CHIMBOTE'),
('02', '13', '02', 'CACERES DEL PERU'),
('02', '13', '03', 'MACATE'),
('02', '13', '04', 'MORO'),
('02', '13', '05', 'NEPEÑA'),
('02', '13', '06', 'SAMANCO'),
('02', '13', '07', 'SANTA'),
('02', '13', '08', 'COISHCO'),
('02', '13', '09', 'NUEVO CHIMBOTE'),
('02', '14', '00', 'SIHUAS'),
('02', '14', '01', 'SIHUAS'),
('02', '14', '02', 'ALFONSO UGARTE'),
('02', '14', '03', 'CHINGALPO'),
('02', '14', '04', 'HUAYLLABAMBA'),
('02', '14', '05', 'QUICHES'),
('02', '14', '06', 'SICSIBAMBA'),
('02', '14', '07', 'ACOBAMBA'),
('02', '14', '08', 'CASHAPAMPA'),
('02', '14', '09', 'RAGASH'),
('02', '14', '10', 'SAN JUAN'),
('02', '15', '00', 'YUNGAY'),
('02', '15', '01', 'YUNGAY'),
('02', '15', '02', 'CASCAPARA'),
('02', '15', '03', 'MANCOS'),
('02', '15', '04', 'MATACOTO'),
('02', '15', '05', 'QUILLO'),
('02', '15', '06', 'RANRAHIRCA'),
('02', '15', '07', 'SHUPLUY'),
('02', '15', '08', 'YANAMA'),
('02', '16', '00', 'ANTONIO RAIMONDI'),
('02', '16', '01', 'LLAMELLIN'),
('02', '16', '02', 'ACZO'),
('02', '16', '03', 'CHACCHO'),
('02', '16', '04', 'CHINGAS'),
('02', '16', '05', 'MIRGAS'),
('02', '16', '06', 'SAN JUAN DE RONTOY'),
('02', '17', '00', 'CARLOS FERMIN FITZCARRALD'),
('02', '17', '01', 'SAN LUIS'),
('02', '17', '02', 'YAUYA'),
('02', '17', '03', 'SAN NICOLAS'),
('02', '18', '00', 'ASUNCION'),
('02', '18', '01', 'CHACAS'),
('02', '18', '02', 'ACOCHACA'),
('02', '19', '00', 'HUARMEY'),
('02', '19', '01', 'HUARMEY'),
('02', '19', '02', 'COCHAPETI'),
('02', '19', '03', 'HUAYAN'),
('02', '19', '04', 'MALVAS'),
('02', '19', '05', 'CULEBRAS'),
('02', '20', '00', 'OCROS'),
('02', '20', '01', 'ACAS'),
('02', '20', '02', 'CAJAMARQUILLA'),
('02', '20', '03', 'CARHUAPAMPA'),
('02', '20', '04', 'COCHAS'),
('02', '20', '05', 'CONGAS'),
('02', '20', '06', 'LLIPA'),
('02', '20', '07', 'OCROS'),
('02', '20', '08', 'SAN CRISTOBAL DE RAJAN'),
('02', '20', '09', 'SAN PEDRO'),
('02', '20', '10', 'SANTIAGO DE CHILCAS'),
('03', '00', '00', 'APURIMAC'),
('03', '01', '00', 'ABANCAY'),
('03', '01', '01', 'ABANCAY'),
('03', '01', '02', 'CIRCA'),
('03', '01', '03', 'CURAHUASI'),
('03', '01', '04', 'CHACOCHE'),
('03', '01', '05', 'HUANIPACA'),
('03', '01', '06', 'LAMBRAMA'),
('03', '01', '07', 'PICHIRHUA'),
('03', '01', '08', 'SAN PEDRO DE CACHORA'),
('03', '01', '09', 'TAMBURCO'),
('03', '02', '00', 'AYMARAES'),
('03', '02', '01', 'CHALHUANCA'),
('03', '02', '02', 'CAPAYA'),
('03', '02', '03', 'CARAYBAMBA'),
('03', '02', '04', 'COLCABAMBA'),
('03', '02', '05', 'COTARUSE'),
('03', '02', '06', 'CHAPIMARCA'),
('03', '02', '07', 'HUAYLLO'),
('03', '02', '08', 'LUCRE'),
('03', '02', '09', 'POCOHUANCA'),
('03', '02', '10', 'SAÑAYCA'),
('03', '02', '11', 'SORAYA'),
('03', '02', '12', 'TAPAIRIHUA'),
('03', '02', '13', 'TINTAY'),
('03', '02', '14', 'TORAYA'),
('03', '02', '15', 'YANACA'),
('03', '02', '16', 'SAN JUAN DE CHACÑA'),
('03', '02', '17', 'JUSTO APU SAHUARAURA'),
('03', '03', '00', 'ANDAHUAYLAS'),
('03', '03', '01', 'ANDAHUAYLAS'),
('03', '03', '02', 'ANDARAPA'),
('03', '03', '03', 'CHIARA'),
('03', '03', '04', 'HUANCARAMA'),
('03', '03', '05', 'HUANCARAY'),
('03', '03', '06', 'KISHUARA'),
('03', '03', '07', 'PACOBAMBA'),
('03', '03', '08', 'PAMPACHIRI'),
('03', '03', '09', 'SAN ANTONIO DE CACHI'),
('03', '03', '10', 'SAN JERONIMO'),
('03', '03', '11', 'TALAVERA'),
('03', '03', '12', 'TURPO'),
('03', '03', '13', 'PACUCHA'),
('03', '03', '14', 'POMACOCHA'),
('03', '03', '15', 'SANTA MARIA DE CHICMO'),
('03', '03', '16', 'TUMAY HUARACA'),
('03', '03', '17', 'HUAYANA'),
('03', '03', '18', 'SAN MIGUEL DE CHACCRAMPA'),
('03', '03', '19', 'KAQUIABAMBA'),
('03', '04', '00', 'ANTABAMBA'),
('03', '04', '01', 'ANTABAMBA'),
('03', '04', '02', 'EL ORO'),
('03', '04', '03', 'HUAQUIRCA'),
('03', '04', '04', 'JUAN ESPINOZA MEDRANO'),
('03', '04', '05', 'OROPESA'),
('03', '04', '06', 'PACHACONAS'),
('03', '04', '07', 'SABAINO'),
('03', '05', '00', 'COTABAMBAS'),
('03', '05', '01', 'TAMBOBAMBA'),
('03', '05', '02', 'COYLLURQUI'),
('03', '05', '03', 'COTABAMBAS'),
('03', '05', '04', 'HAQUIRA'),
('03', '05', '05', 'MARA'),
('03', '05', '06', 'CHALLHUAHUACHO'),
('03', '06', '00', 'GRAU'),
('03', '06', '01', 'CHUQUIBAMBILLA'),
('03', '06', '02', 'CURPAHUASI'),
('03', '06', '03', 'HUAILLATI'),
('03', '06', '04', 'MAMARA'),
('03', '06', '05', 'MARISCAL GAMARRA'),
('03', '06', '06', 'MICAELA BASTIDAS'),
('03', '06', '07', 'PROGRESO'),
('03', '06', '08', 'PATAYPAMPA'),
('03', '06', '09', 'SAN ANTONIO'),
('03', '06', '10', 'TURPAY'),
('03', '06', '11', 'VILCABAMBA'),
('03', '06', '12', 'VIRUNDO'),
('03', '06', '13', 'SANTA ROSA'),
('03', '06', '14', 'CURASCO'),
('03', '07', '00', 'CHINCHEROS'),
('03', '07', '01', 'CHINCHEROS'),
('03', '07', '02', 'ONGOY'),
('03', '07', '03', 'OCOBAMBA'),
('03', '07', '04', 'COCHARCAS'),
('03', '07', '05', 'ANCO HUALLO'),
('03', '07', '06', 'HUACCANA'),
('03', '07', '07', 'URANMARCA'),
('03', '07', '08', 'RANRACANCHA'),
('04', '00', '00', 'AREQUIPA'),
('04', '01', '00', 'AREQUIPA'),
('04', '01', '01', 'AREQUIPA'),
('04', '01', '02', 'CAYMA'),
('04', '01', '03', 'CERRO COLORADO'),
('04', '01', '04', 'CHARACATO'),
('04', '01', '05', 'CHIGUATA'),
('04', '01', '06', 'LA JOYA'),
('04', '01', '07', 'MIRAFLORES'),
('04', '01', '08', 'MOLLEBAYA'),
('04', '01', '09', 'PAUCARPATA'),
('04', '01', '10', 'POCSI'),
('04', '01', '11', 'POLOBAYA'),
('04', '01', '12', 'QUEQUEÑA'),
('04', '01', '13', 'SABANDIA'),
('04', '01', '14', 'SACHACA'),
('04', '01', '15', 'SAN JUAN DE SIGUAS'),
('04', '01', '16', 'SAN JUAN DE TARUCANI'),
('04', '01', '17', 'SANTA ISABEL DE SIGUAS'),
('04', '01', '18', 'SANTA RITA DE SIHUAS'),
('04', '01', '19', 'SOCABAYA'),
('04', '01', '20', 'TIABAYA'),
('04', '01', '21', 'UCHUMAYO'),
('04', '01', '22', 'VITOR'),
('04', '01', '23', 'YANAHUARA'),
('04', '01', '24', 'YARABAMBA'),
('04', '01', '25', 'YURA'),
('04', '01', '26', 'MARIANO MELGAR'),
('04', '01', '27', 'JACOBO HUNTER'),
('04', '01', '28', 'ALTO SELVA ALEGRE'),
('04', '01', '29', 'JOSE LUIS BUSTAMANTE Y RIVERO'),
('04', '02', '00', 'CAYLLOMA'),
('04', '02', '01', 'CHIVAY'),
('04', '02', '02', 'ACHOMA'),
('04', '02', '03', 'CABANACONDE'),
('04', '02', '04', 'CAYLLOMA'),
('04', '02', '05', 'CALLALLI'),
('04', '02', '06', 'COPORAQUE'),
('04', '02', '07', 'HUAMBO'),
('04', '02', '08', 'HUANCA'),
('04', '02', '09', 'ICHUPAMPA'),
('04', '02', '10', 'LARI'),
('04', '02', '11', 'LLUTA'),
('04', '02', '12', 'MACA'),
('04', '02', '13', 'MADRIGAL'),
('04', '02', '14', 'SAN ANTONIO DE CHUCA'),
('04', '02', '15', 'SIBAYO'),
('04', '02', '16', 'TAPAY'),
('04', '02', '17', 'TISCO'),
('04', '02', '18', 'TUTI'),
('04', '02', '19', 'YANQUE'),
('04', '02', '20', 'MAJES'),
('04', '03', '00', 'CAMANA'),
('04', '03', '01', 'CAMANA'),
('04', '03', '02', 'JOSE MARIA QUIMPER'),
('04', '03', '03', 'MARIANO NICOLAS VALCARCEL'),
('04', '03', '04', 'MARISCAL CACERES'),
('04', '03', '05', 'NICOLAS DE PIEROLA'),
('04', '03', '06', 'OCOÑA'),
('04', '03', '07', 'QUILCA'),
('04', '03', '08', 'SAMUEL PASTOR'),
('04', '04', '00', 'CARAVELI'),
('04', '04', '01', 'CARAVELI'),
('04', '04', '02', 'ACARI'),
('04', '04', '03', 'ATICO'),
('04', '04', '04', 'ATIQUIPA'),
('04', '04', '05', 'BELLA UNION'),
('04', '04', '06', 'CAHUACHO'),
('04', '04', '07', 'CHALA'),
('04', '04', '08', 'CHAPARRA'),
('04', '04', '09', 'HUANUHUANU'),
('04', '04', '10', 'JAQUI'),
('04', '04', '11', 'LOMAS'),
('04', '04', '12', 'QUICACHA'),
('04', '04', '13', 'YAUCA'),
('04', '05', '00', 'CASTILLA'),
('04', '05', '01', 'APLAO'),
('04', '05', '02', 'ANDAGUA'),
('04', '05', '03', 'AYO'),
('04', '05', '04', 'CHACHAS'),
('04', '05', '05', 'CHILCAYMARCA'),
('04', '05', '06', 'CHOCO'),
('04', '05', '07', 'HUANCARQUI'),
('04', '05', '08', 'MACHAGUAY'),
('04', '05', '09', 'ORCOPAMPA'),
('04', '05', '10', 'PAMPACOLCA'),
('04', '05', '11', 'TIPAN'),
('04', '05', '12', 'URACA'),
('04', '05', '13', 'UÑON'),
('04', '05', '14', 'VIRACO'),
('04', '06', '00', 'CONDESUYOS'),
('04', '06', '01', 'CHUQUIBAMBA'),
('04', '06', '02', 'ANDARAY'),
('04', '06', '03', 'CAYARANI'),
('04', '06', '04', 'CHICHAS'),
('04', '06', '05', 'IRAY'),
('04', '06', '06', 'SALAMANCA'),
('04', '06', '07', 'YANAQUIHUA'),
('04', '06', '08', 'RIO GRANDE'),
('04', '07', '00', 'ISLAY'),
('04', '07', '01', 'MOLLENDO'),
('04', '07', '02', 'COCACHACRA'),
('04', '07', '03', 'DEAN VALDIVIA'),
('04', '07', '04', 'ISLAY'),
('04', '07', '05', 'MEJIA'),
('04', '07', '06', 'PUNTA DE BOMBON'),
('04', '08', '00', 'LA UNION'),
('04', '08', '01', 'COTAHUASI'),
('04', '08', '02', 'ALCA'),
('04', '08', '03', 'CHARCANA'),
('04', '08', '04', 'HUAYNACOTAS'),
('04', '08', '05', 'PAMPAMARCA'),
('04', '08', '06', 'PUYCA'),
('04', '08', '07', 'QUECHUALLA'),
('04', '08', '08', 'SAYLA'),
('04', '08', '09', 'TAURIA'),
('04', '08', '10', 'TOMEPAMPA'),
('04', '08', '11', 'TORO'),
('05', '00', '00', 'AYACUCHO'),
('05', '01', '00', 'HUAMANGA'),
('05', '01', '01', 'AYACUCHO'),
('05', '01', '02', 'ACOS VINCHOS'),
('05', '01', '03', 'CARMEN ALTO'),
('05', '01', '04', 'CHIARA'),
('05', '01', '05', 'QUINUA'),
('05', '01', '06', 'SAN JOSE DE TICLLAS'),
('05', '01', '07', 'SAN JUAN BAUTISTA'),
('05', '01', '08', 'SANTIAGO DE PISCHA'),
('05', '01', '09', 'VINCHOS'),
('05', '01', '10', 'TAMBILLO'),
('05', '01', '11', 'ACOCRO'),
('05', '01', '12', 'SOCOS'),
('05', '01', '13', 'OCROS'),
('05', '01', '14', 'PACAYCASA'),
('05', '01', '15', 'JESUS NAZARENO'),
('05', '02', '00', 'CANGALLO'),
('05', '02', '01', 'CANGALLO'),
('05', '02', '04', 'CHUSCHI'),
('05', '02', '06', 'LOS MOROCHUCOS'),
('05', '02', '07', 'PARAS'),
('05', '02', '08', 'TOTOS'),
('05', '02', '11', 'MARIA PARADO DE BELLIDO'),
('05', '03', '00', 'HUANTA'),
('05', '03', '01', 'HUANTA'),
('05', '03', '02', 'AYAHUANCO'),
('05', '03', '03', 'HUAMANGUILLA'),
('05', '03', '04', 'IGUAIN'),
('05', '03', '05', 'LURICOCHA'),
('05', '03', '07', 'SANTILLANA'),
('05', '03', '08', 'SIVIA'),
('05', '03', '09', 'LLOCHEGUA'),
('05', '04', '00', 'LA MAR'),
('05', '04', '01', 'SAN MIGUEL'),
('05', '04', '02', 'ANCO'),
('05', '04', '03', 'AYNA'),
('05', '04', '04', 'CHILCAS'),
('05', '04', '05', 'CHUNGUI'),
('05', '04', '06', 'TAMBO'),
('05', '04', '07', 'LUIS CARRANZA'),
('05', '04', '08', 'SANTA ROSA'),
('05', '04', '09', 'SAMUGARI'),
('05', '05', '00', 'LUCANAS'),
('05', '05', '01', 'PUQUIO'),
('05', '05', '02', 'AUCARA'),
('05', '05', '03', 'CABANA'),
('05', '05', '04', 'CARMEN SALCEDO'),
('05', '05', '06', 'CHAVIÑA'),
('05', '05', '08', 'CHIPAO'),
('05', '05', '10', 'HUAC-HUAS'),
('05', '05', '11', 'LARAMATE'),
('05', '05', '12', 'LEONCIO PRADO'),
('05', '05', '13', 'LUCANAS'),
('05', '05', '14', 'LLAUTA'),
('05', '05', '16', 'OCAÑA'),
('05', '05', '17', 'OTOCA'),
('05', '05', '20', 'SANCOS'),
('05', '05', '21', 'SAN JUAN'),
('05', '05', '22', 'SAN PEDRO'),
('05', '05', '24', 'SANTA ANA DE HUAYCAHUACHO'),
('05', '05', '25', 'SANTA LUCIA'),
('05', '05', '29', 'SAISA'),
('05', '05', '31', 'SAN PEDRO DE PALCO'),
('05', '05', '32', 'SAN CRISTOBAL'),
('05', '06', '00', 'PARINACOCHAS'),
('05', '06', '01', 'CORACORA'),
('05', '06', '04', 'CORONEL CASTAÑEDA'),
('05', '06', '05', 'CHUMPI'),
('05', '06', '08', 'PACAPAUSA'),
('05', '06', '11', 'PULLO'),
('05', '06', '12', 'PUYUSCA'),
('05', '06', '15', 'SAN FRANCISCO DE RAVACAYCO'),
('05', '06', '16', 'UPAHUACHO'),
('05', '07', '00', 'VICTOR FAJARDO'),
('05', '07', '01', 'HUANCAPI'),
('05', '07', '02', 'ALCAMENCA'),
('05', '07', '03', 'APONGO'),
('05', '07', '04', 'CANARIA'),
('05', '07', '06', 'CAYARA'),
('05', '07', '07', 'COLCA'),
('05', '07', '08', 'HUALLA'),
('05', '07', '09', 'HUAMANQUIQUIA'),
('05', '07', '10', 'HUANCARAYLLA'),
('05', '07', '13', 'SARHUA'),
('05', '07', '14', 'VILCANCHOS'),
('05', '07', '15', 'ASQUIPATA'),
('05', '08', '00', 'HUANCA SANCOS'),
('05', '08', '01', 'SANCOS'),
('05', '08', '02', 'SACSAMARCA'),
('05', '08', '03', 'SANTIAGO DE LUCANAMARCA'),
('05', '08', '04', 'CARAPO'),
('05', '09', '00', 'VILCAS HUAMAN'),
('05', '09', '01', 'VILCAS HUAMAN'),
('05', '09', '02', 'VISCHONGO'),
('05', '09', '03', 'ACCOMARCA'),
('05', '09', '04', 'CARHUANCA'),
('05', '09', '05', 'CONCEPCION'),
('05', '09', '06', 'HUAMBALPA'),
('05', '09', '07', 'SAURAMA'),
('05', '09', '08', 'INDEPENDENCIA'),
('05', '10', '00', 'PAUCAR DEL SARA SARA'),
('05', '10', '01', 'PAUSA'),
('05', '10', '02', 'COLTA'),
('05', '10', '03', 'CORCULLA'),
('05', '10', '04', 'LAMPA'),
('05', '10', '05', 'MARCABAMBA'),
('05', '10', '06', 'OYOLO'),
('05', '10', '07', 'PARARCA'),
('05', '10', '08', 'SAN JAVIER DE ALPABAMBA'),
('05', '10', '09', 'SAN JOSE DE USHUA'),
('05', '10', '10', 'SARA SARA'),
('05', '11', '00', 'SUCRE'),
('05', '11', '01', 'QUEROBAMBA'),
('05', '11', '02', 'BELEN'),
('05', '11', '03', 'CHALCOS'),
('05', '11', '04', 'SAN SALVADOR DE QUIJE'),
('05', '11', '05', 'PAICO'),
('05', '11', '06', 'SANTIAGO DE PAUCARAY'),
('05', '11', '07', 'SAN PEDRO DE LARCAY'),
('05', '11', '08', 'SORAS'),
('05', '11', '09', 'HUACAÑA'),
('05', '11', '10', 'CHILCAYOC'),
('05', '11', '11', 'MORCOLLA'),
('06', '00', '00', 'CAJAMARCA'),
('06', '01', '00', 'CAJAMARCA'),
('06', '01', '01', 'CAJAMARCA'),
('06', '01', '02', 'ASUNCION'),
('06', '01', '03', 'COSPAN'),
('06', '01', '04', 'CHETILLA'),
('06', '01', '05', 'ENCAÑADA'),
('06', '01', '06', 'JESUS'),
('06', '01', '07', 'LOS BAÑOS DEL INCA'),
('06', '01', '08', 'LLACANORA'),
('06', '01', '09', 'MAGDALENA'),
('06', '01', '10', 'MATARA'),
('06', '01', '11', 'NAMORA'),
('06', '01', '12', 'SAN JUAN'),
('06', '02', '00', 'CAJABAMBA'),
('06', '02', '01', 'CAJABAMBA'),
('06', '02', '02', 'CACHACHI'),
('06', '02', '03', 'CONDEBAMBA'),
('06', '02', '05', 'SITACOCHA'),
('06', '03', '00', 'CELENDIN'),
('06', '03', '01', 'CELENDIN'),
('06', '03', '02', 'CORTEGANA'),
('06', '03', '03', 'CHUMUCH'),
('06', '03', '04', 'HUASMIN'),
('06', '03', '05', 'JORGE CHAVEZ'),
('06', '03', '06', 'JOSE GALVEZ'),
('06', '03', '07', 'MIGUEL IGLESIAS'),
('06', '03', '08', 'OXAMARCA'),
('06', '03', '09', 'SOROCHUCO'),
('06', '03', '10', 'SUCRE'),
('06', '03', '11', 'UTCO'),
('06', '03', '12', 'LA LIBERTAD DE PALLAN'),
('06', '04', '00', 'CONTUMAZA'),
('06', '04', '01', 'CONTUMAZA'),
('06', '04', '03', 'CHILETE'),
('06', '04', '04', 'GUZMANGO'),
('06', '04', '05', 'SAN BENITO'),
('06', '04', '06', 'CUPISNIQUE'),
('06', '04', '07', 'TANTARICA'),
('06', '04', '08', 'YONAN'),
('06', '04', '09', 'SANTA CRUZ DE TOLED'),
('06', '05', '00', 'CUTERVO'),
('06', '05', '01', 'CUTERVO'),
('06', '05', '02', 'CALLAYUC'),
('06', '05', '03', 'CUJILLO'),
('06', '05', '04', 'CHOROS'),
('06', '05', '05', 'LA RAMADA'),
('06', '05', '06', 'PIMPINGOS'),
('06', '05', '07', 'QUEROCOTILLO'),
('06', '05', '08', 'SAN ANDRES DE CUTERVO'),
('06', '05', '09', 'SAN JUAN DE CUTERVO'),
('06', '05', '10', 'SAN LUIS DE LUCMA'),
('06', '05', '11', 'SANTA CRUZ'),
('06', '05', '12', 'SANTO DOMINGO DE LA CAPILLA'),
('06', '05', '13', 'SANTO TOMAS'),
('06', '05', '14', 'SOCOTA'),
('06', '05', '15', 'TORIBIO CASANOVA'),
('06', '06', '00', 'CHOTA'),
('06', '06', '01', 'CHOTA'),
('06', '06', '02', 'ANGUIA'),
('06', '06', '03', 'COCHABAMBA'),
('06', '06', '04', 'CONCHAN'),
('06', '06', '05', 'CHADIN'),
('06', '06', '06', 'CHIGUIRIP'),
('06', '06', '07', 'CHIMBAN'),
('06', '06', '08', 'HUAMBOS'),
('06', '06', '09', 'LAJAS'),
('06', '06', '10', 'LLAMA'),
('06', '06', '11', 'MIRACOSTA'),
('06', '06', '12', 'PACCHA'),
('06', '06', '13', 'PION'),
('06', '06', '14', 'QUEROCOTO'),
('06', '06', '15', 'TACABAMBA'),
('06', '06', '16', 'TOCMOCHE'),
('06', '06', '17', 'SAN JUAN DE LICUPIS'),
('06', '06', '18', 'CHOROPAMPA'),
('06', '06', '19', 'CHALAMARCA'),
('06', '07', '00', 'HUALGAYOC'),
('06', '07', '01', 'BAMBAMARCA'),
('06', '07', '02', 'CHUGUR'),
('06', '07', '03', 'HUALGAYOC'),
('06', '08', '00', 'JAEN'),
('06', '08', '01', 'JAEN'),
('06', '08', '02', 'BELLAVISTA'),
('06', '08', '03', 'COLASAY'),
('06', '08', '04', 'CHONTALI'),
('06', '08', '05', 'POMAHUACA'),
('06', '08', '06', 'PUCARA'),
('06', '08', '07', 'SALLIQUE'),
('06', '08', '08', 'SAN FELIPE'),
('06', '08', '09', 'SAN JOSE DEL ALTO'),
('06', '08', '10', 'SANTA ROSA'),
('06', '08', '11', 'LAS PIRIAS'),
('06', '08', '12', 'HUABAL'),
('06', '09', '00', 'SANTA CRUZ'),
('06', '09', '01', 'SANTA CRUZ'),
('06', '09', '02', 'CATACHE'),
('06', '09', '03', 'CHANCAYBAÑOS'),
('06', '09', '04', 'LA ESPERANZA'),
('06', '09', '05', 'NINABAMBA'),
('06', '09', '06', 'PULAN'),
('06', '09', '07', 'SEXI'),
('06', '09', '08', 'UTICYACU'),
('06', '09', '09', 'YAUYUCAN'),
('06', '09', '10', 'ANDABAMBA'),
('06', '09', '11', 'SAUCEPAMPA'),
('06', '10', '00', 'SAN MIGUEL'),
('06', '10', '01', 'SAN MIGUEL'),
('06', '10', '02', 'CALQUIS'),
('06', '10', '03', 'LA FLORIDA'),
('06', '10', '04', 'LLAPA'),
('06', '10', '05', 'NANCHOC'),
('06', '10', '06', 'NIEPOS'),
('06', '10', '07', 'SAN GREGORIO'),
('06', '10', '08', 'SAN SILVESTRE DE COCHAN'),
('06', '10', '09', 'EL PRADO'),
('06', '10', '10', 'UNION AGUA BLANCA'),
('06', '10', '11', 'TONGOD'),
('06', '10', '12', 'CATILLUC'),
('06', '10', '13', 'BOLIVAR'),
('06', '11', '00', 'SAN IGNACIO'),
('06', '11', '01', 'SAN IGNACIO'),
('06', '11', '02', 'CHIRINOS'),
('06', '11', '03', 'HUARANGO'),
('06', '11', '04', 'NAMBALLE'),
('06', '11', '05', 'LA COIPA'),
('06', '11', '06', 'SAN JOSE DE LOURDES'),
('06', '11', '07', 'TABACONAS'),
('06', '12', '00', 'SAN MARCOS'),
('06', '12', '01', 'PEDRO GALVEZ'),
('06', '12', '02', 'ICHOCAN'),
('06', '12', '03', 'GREGORIO PITA'),
('06', '12', '04', 'JOSE MANUEL QUIROZ'),
('06', '12', '05', 'EDUARDO VILLANUEVA'),
('06', '12', '06', 'JOSE SABOGAL'),
('06', '12', '07', 'CHANCAY'),
('06', '13', '00', 'SAN PABLO'),
('06', '13', '01', 'SAN PABLO'),
('06', '13', '02', 'SAN BERNARDINO'),
('06', '13', '03', 'SAN LUIS'),
('06', '13', '04', 'TUMBADEN'),
('07', '00', '00', 'CUSCO'),
('07', '01', '00', 'CUSCO'),
('07', '01', '01', 'CUSCO'),
('07', '01', '02', 'CCORCA'),
('07', '01', '03', 'POROY'),
('07', '01', '04', 'SAN JERONIMO'),
('07', '01', '05', 'SAN SEBASTIAN'),
('07', '01', '06', 'SANTIAGO'),
('07', '01', '07', 'SAYLLA'),
('07', '01', '08', 'WANCHAQ'),
('07', '02', '00', 'ACOMAYO'),
('07', '02', '01', 'ACOMAYO'),
('07', '02', '02', 'ACOPIA'),
('07', '02', '03', 'ACOS'),
('07', '02', '04', 'POMACANCHI'),
('07', '02', '05', 'RONDOCAN'),
('07', '02', '06', 'SANGARARA'),
('07', '02', '07', 'MOSOC LLACTA'),
('07', '03', '00', 'ANTA'),
('07', '03', '01', 'ANTA'),
('07', '03', '02', 'CHINCHAYPUJIO'),
('07', '03', '03', 'HUAROCONDO'),
('07', '03', '04', 'LIMATAMBO'),
('07', '03', '05', 'MOLLEPATA'),
('07', '03', '06', 'PUCYURA'),
('07', '03', '07', 'ZURITE'),
('07', '03', '08', 'CACHIMAYO'),
('07', '03', '09', 'ANCAHUASI'),
('07', '04', '00', 'CALCA'),
('07', '04', '01', 'CALCA'),
('07', '04', '02', 'COYA'),
('07', '04', '03', 'LAMAY'),
('07', '04', '04', 'LARES'),
('07', '04', '05', 'PISAC'),
('07', '04', '06', 'SAN SALVADOR'),
('07', '04', '07', 'TARAY'),
('07', '04', '08', 'YANATILE'),
('07', '05', '00', 'CANAS'),
('07', '05', '01', 'YANAOCA'),
('07', '05', '02', 'CHECCA'),
('07', '05', '03', 'KUNTURKANKI'),
('07', '05', '04', 'LANGUI'),
('07', '05', '05', 'LAYO'),
('07', '05', '06', 'PAMPAMARCA'),
('07', '05', '07', 'QUEHUE'),
('07', '05', '08', 'TUPAC AMARU'),
('07', '06', '00', 'CANCHIS'),
('07', '06', '01', 'SICUANI'),
('07', '06', '02', 'COMBAPATA'),
('07', '06', '03', 'CHECACUPE'),
('07', '06', '04', 'MARANGANI'),
('07', '06', '05', 'PITUMARCA'),
('07', '06', '06', 'SAN PABLO'),
('07', '06', '07', 'SAN PEDRO'),
('07', '06', '08', 'TINTA'),
('07', '07', '00', 'CHUMBIVILCAS'),
('07', '07', '01', 'SANTO TOMAS'),
('07', '07', '02', 'CAPACMARCA'),
('07', '07', '03', 'COLQUEMARCA'),
('07', '07', '04', 'CHAMACA'),
('07', '07', '05', 'LIVITACA'),
('07', '07', '06', 'LLUSCO'),
('07', '07', '07', 'QUIÑOTA'),
('07', '07', '08', 'VELILLE'),
('07', '08', '00', 'ESPINAR'),
('07', '08', '01', 'ESPINAR'),
('07', '08', '02', 'CONDOROMA'),
('07', '08', '03', 'COPORAQUE'),
('07', '08', '04', 'OCORURO'),
('07', '08', '05', 'PALLPATA'),
('07', '08', '06', 'PICHIGUA'),
('07', '08', '07', 'SUYCKUTAMBO'),
('07', '08', '08', 'ALTO PICHIGUA'),
('07', '09', '00', 'LA CONVENCION'),
('07', '09', '01', 'SANTA ANA'),
('07', '09', '02', 'ECHARATE'),
('07', '09', '03', 'HUAYOPATA'),
('07', '09', '04', 'MARANURA'),
('07', '09', '05', 'OCOBAMBA'),
('07', '09', '06', 'SANTA TERESA'),
('07', '09', '07', 'VILCABAMBA'),
('07', '09', '08', 'QUELLOUNO'),
('07', '09', '09', 'KIMBIRI'),
('07', '09', '10', 'PICHARI'),
('07', '10', '00', 'PARURO'),
('07', '10', '01', 'PARURO'),
('07', '10', '02', 'ACCHA'),
('07', '10', '03', 'CCAPI'),
('07', '10', '04', 'COLCHA'),
('07', '10', '05', 'HUANOQUITE'),
('07', '10', '06', 'OMACHA'),
('07', '10', '07', 'YAURISQUE'),
('07', '10', '08', 'PACCARITAMBO'),
('07', '10', '09', 'PILLPINTO'),
('07', '11', '00', 'PAUCARTAMBO'),
('07', '11', '01', 'PAUCARTAMBO'),
('07', '11', '02', 'CAICAY'),
('07', '11', '03', 'COLQUEPATA'),
('07', '11', '04', 'CHALLABAMBA'),
('07', '11', '05', 'KOSÑIPATA'),
('07', '11', '06', 'HUANCARANI'),
('07', '12', '00', 'QUISPICANCHI'),
('07', '12', '01', 'URCOS'),
('07', '12', '02', 'ANDAHUAYLILLAS'),
('07', '12', '03', 'CAMANTI'),
('07', '12', '04', 'CCARHUAYO'),
('07', '12', '05', 'CCATCA'),
('07', '12', '06', 'CUSIPATA'),
('07', '12', '07', 'HUARO'),
('07', '12', '08', 'LUCRE'),
('07', '12', '09', 'MARCAPATA'),
('07', '12', '10', 'OCONGATE'),
('07', '12', '11', 'OROPESA'),
('07', '12', '12', 'QUIQUIJANA'),
('07', '13', '00', 'URUBAMBA'),
('07', '13', '01', 'URUBAMBA'),
('07', '13', '02', 'CHINCHERO'),
('07', '13', '03', 'HUAYLLABAMBA'),
('07', '13', '04', 'MACHUPICCHU'),
('07', '13', '05', 'MARAS'),
('07', '13', '06', 'OLLANTAYTAMBO'),
('07', '13', '07', 'YUCAY'),
('08', '00', '00', 'HUANCAVELICA'),
('08', '01', '00', 'HUANCAVELICA'),
('08', '01', '01', 'HUANCAVELICA'),
('08', '01', '02', 'ACOBAMBILLA'),
('08', '01', '03', 'ACORIA'),
('08', '01', '04', 'CONAYCA'),
('08', '01', '05', 'CUENCA'),
('08', '01', '06', 'HUACHOCOLPA'),
('08', '01', '08', 'HUAYLLAHUARA'),
('08', '01', '09', 'IZCUCHACA'),
('08', '01', '10', 'LARIA'),
('08', '01', '11', 'MANTA'),
('08', '01', '12', 'MARISCAL CACERES'),
('08', '01', '13', 'MOYA'),
('08', '01', '14', 'NUEVO OCCORO'),
('08', '01', '15', 'PALCA'),
('08', '01', '16', 'PILCHACA'),
('08', '01', '17', 'VILCA'),
('08', '01', '18', 'YAULI'),
('08', '01', '19', 'ASCENSION'),
('08', '01', '20', 'HUANDO'),
('08', '02', '00', 'ACOBAMBA'),
('08', '02', '01', 'ACOBAMBA'),
('08', '02', '02', 'ANTA'),
('08', '02', '03', 'ANDABAMBA'),
('08', '02', '04', 'CAJA'),
('08', '02', '05', 'MARCAS'),
('08', '02', '06', 'PAUCARA'),
('08', '02', '07', 'POMACOCHA'),
('08', '02', '08', 'ROSARIO'),
('08', '03', '00', 'ANGARAES'),
('08', '03', '01', 'LIRCAY'),
('08', '03', '02', 'ANCHONGA'),
('08', '03', '03', 'CALLANMARCA'),
('08', '03', '04', 'CONGALLA'),
('08', '03', '05', 'CHINCHO'),
('08', '03', '06', 'HUALLAY-GRANDE'),
('08', '03', '07', 'HUANCA-HUANCA'),
('08', '03', '08', 'JULCAMARCA'),
('08', '03', '09', 'SAN ANTONIO DE ANTAPARCO'),
('08', '03', '10', 'SANTO TOMAS DE PATA'),
('08', '03', '11', 'SECCLLA'),
('08', '03', '12', 'CCOCHACCASA'),
('08', '04', '00', 'CASTROVIRREYNA'),
('08', '04', '01', 'CASTROVIRREYNA'),
('08', '04', '02', 'ARMA'),
('08', '04', '03', 'AURAHUA'),
('08', '04', '05', 'CAPILLAS'),
('08', '04', '06', 'COCAS'),
('08', '04', '08', 'CHUPAMARCA'),
('08', '04', '09', 'HUACHOS'),
('08', '04', '10', 'HUAMATAMBO'),
('08', '04', '14', 'MOLLEPAMPA'),
('08', '04', '22', 'SAN JUAN'),
('08', '04', '27', 'TANTARA'),
('08', '04', '28', 'TICRAPO'),
('08', '04', '29', 'SANTA ANA'),
('08', '05', '00', 'TAYACAJA'),
('08', '05', '01', 'PAMPAS'),
('08', '05', '02', 'ACOSTAMBO'),
('08', '05', '03', 'ACRAQUIA'),
('08', '05', '04', 'AHUAYCHA'),
('08', '05', '06', 'COLCABAMBA'),
('08', '05', '09', 'DANIEL HERNANDEZ'),
('08', '05', '11', 'HUACHOCOLPA'),
('08', '05', '12', 'HUARIBAMBA'),
('08', '05', '15', 'ÑAHUIMPUQUIO'),
('08', '05', '17', 'PAZOS'),
('08', '05', '18', 'QUISHUAR'),
('08', '05', '19', 'SALCABAMBA'),
('08', '05', '20', 'SAN MARCOS DE ROCCHAC'),
('08', '05', '23', 'SURCUBAMBA'),
('08', '05', '25', 'TINTAY PUNCU'),
('08', '05', '26', 'SALCAHUASI'),
('08', '06', '00', 'HUAYTARA'),
('08', '06', '01', 'AYAVI'),
('08', '06', '02', 'CORDOVA'),
('08', '06', '03', 'HUAYACUNDO ARMA'),
('08', '06', '04', 'HUAYTARA'),
('08', '06', '05', 'LARAMARCA'),
('08', '06', '06', 'OCOYO'),
('08', '06', '07', 'PILPICHACA'),
('08', '06', '08', 'QUERCO'),
('08', '06', '09', 'QUITO ARMA'),
('08', '06', '10', 'SAN ANTONIO DE CUSICANCHA'),
('08', '06', '11', 'SAN FRANCISCO DE SANGAYAICO'),
('08', '06', '12', 'SAN ISIDRO'),
('08', '06', '13', 'SANTIAGO DE CHOCORVOS'),
('08', '06', '14', 'SANTIAGO DE QUIRAHUARA'),
('08', '06', '15', 'SANTO DOMINGO DE CAPILLAS'),
('08', '06', '16', 'TAMBO'),
('08', '07', '00', 'CHURCAMPA'),
('08', '07', '01', 'CHURCAMPA'),
('08', '07', '02', 'ANCO'),
('08', '07', '03', 'CHINCHIHUASI'),
('08', '07', '04', 'EL CARMEN'),
('08', '07', '05', 'LA MERCED'),
('08', '07', '06', 'LOCROJA'),
('08', '07', '07', 'PAUCARBAMBA'),
('08', '07', '08', 'SAN MIGUEL DE MAYOCC'),
('08', '07', '09', 'SAN PEDRO DE CORIS'),
('08', '07', '10', 'PACHAMARCA'),
('08', '07', '11', 'COSME'),
('09', '00', '00', 'HUANUCO'),
('09', '01', '00', 'HUANUCO'),
('09', '01', '01', 'HUANUCO'),
('09', '01', '02', 'CHINCHAO'),
('09', '01', '03', 'CHURUBAMBA'),
('09', '01', '04', 'MARGOS'),
('09', '01', '05', 'QUISQUI'),
('09', '01', '06', 'SAN FRANCISCO DE CAYRAN'),
('09', '01', '07', 'SAN PEDRO DE CHAULAN'),
('09', '01', '08', 'SANTA MARIA DEL VALLE'),
('09', '01', '09', 'YARUMAYO'),
('09', '01', '10', 'AMARILIS'),
('09', '01', '11', 'PILLCO MARCA'),
('09', '01', '12', 'YACUS'),
('09', '02', '00', 'AMBO'),
('09', '02', '01', 'AMBO'),
('09', '02', '02', 'CAYNA'),
('09', '02', '03', 'COLPAS'),
('09', '02', '04', 'CONCHAMARCA'),
('09', '02', '05', 'HUACAR'),
('09', '02', '06', 'SAN FRANCISCO'),
('09', '02', '07', 'SAN RAFAEL'),
('09', '02', '08', 'TOMAY-KICHWA'),
('09', '03', '00', 'DOS DE MAYO'),
('09', '03', '01', 'LA UNION'),
('09', '03', '07', 'CHUQUIS'),
('09', '03', '12', 'MARIAS'),
('09', '03', '14', 'PACHAS'),
('09', '03', '16', 'QUIVILLA'),
('09', '03', '17', 'RIPAN'),
('09', '03', '21', 'SHUNQUI'),
('09', '03', '22', 'SILLAPATA'),
('09', '03', '23', 'YANAS'),
('09', '04', '00', 'HUAMALIES'),
('09', '04', '01', 'LLATA'),
('09', '04', '02', 'ARANCAY'),
('09', '04', '03', 'CHAVIN DE PARIARCA'),
('09', '04', '04', 'JACAS GRANDE'),
('09', '04', '05', 'JIRCAN'),
('09', '04', '06', 'MIRAFLORES'),
('09', '04', '07', 'MONZON'),
('09', '04', '08', 'PUNCHAO'),
('09', '04', '09', 'PUÑOS'),
('09', '04', '10', 'SINGA'),
('09', '04', '11', 'TANTAMAYO'),
('09', '05', '00', 'MARAÑON'),
('09', '05', '01', 'HUACRACHUCO'),
('09', '05', '02', 'CHOLON'),
('09', '05', '05', 'SAN BUENAVENTURA'),
('09', '06', '00', 'LEONCIO PRADO'),
('09', '06', '01', 'RUPA-RUPA'),
('09', '06', '02', 'DANIEL ALOMIA ROBLES'),
('09', '06', '03', 'HERMILIO VALDIZAN'),
('09', '06', '04', 'LUYANDO'),
('09', '06', '05', 'MARIANO DAMASO BERAUN'),
('09', '06', '06', 'JOSE CRESPO Y CASTILLO'),
('09', '07', '00', 'PACHITEA'),
('09', '07', '01', 'PANAO'),
('09', '07', '02', 'CHAGLLA'),
('09', '07', '04', 'MOLINO'),
('09', '07', '06', 'UMARI'),
('09', '08', '00', 'PUERTO INCA'),
('09', '08', '01', 'HONORIA'),
('09', '08', '02', 'PUERTO INCA'),
('09', '08', '03', 'CODO DEL POZUZO'),
('09', '08', '04', 'TOURNAVISTA'),
('09', '08', '05', 'YUYAPICHIS'),
('09', '09', '00', 'HUACAYBAMBA'),
('09', '09', '01', 'HUACAYBAMBA'),
('09', '09', '02', 'PINRA'),
('09', '09', '03', 'CANCHABAMBA'),
('09', '09', '04', 'COCHABAMBA'),
('09', '10', '00', 'LAURICOCHA'),
('09', '10', '01', 'JESUS'),
('09', '10', '02', 'BAÑOS'),
('09', '10', '03', 'SAN FRANCISCO DE ASIS'),
('09', '10', '04', 'QUEROPALCA'),
('09', '10', '05', 'SAN MIGUEL DE CAURI'),
('09', '10', '06', 'RONDOS'),
('09', '10', '07', 'JIVIA'),
('09', '11', '00', 'YAROWILCA'),
('09', '11', '01', 'CHAVINILLO'),
('09', '11', '02', 'APARICIO POMARES'),
('09', '11', '03', 'CAHUAC'),
('09', '11', '04', 'CHACABAMBA'),
('09', '11', '05', 'JACAS CHICO'),
('09', '11', '06', 'OBAS'),
('09', '11', '07', 'PAMPAMARCA'),
('09', '11', '08', 'CHORAS'),
('10', '00', '00', 'ICA'),
('10', '01', '00', 'ICA'),
('10', '01', '01', 'ICA'),
('10', '01', '02', 'LA TINGUIÑA'),
('10', '01', '03', 'LOS AQUIJES'),
('10', '01', '04', 'PARCONA'),
('10', '01', '05', 'PUEBLO NUEVO'),
('10', '01', '06', 'SALAS'),
('10', '01', '07', 'SAN JOSE DE LOS MOLINOS'),
('10', '01', '08', 'SAN JUAN BAUTISTA'),
('10', '01', '09', 'SANTIAGO'),
('10', '01', '10', 'SUBTANJALLA'),
('10', '01', '11', 'YAUCA DEL ROSARIO'),
('10', '01', '12', 'TATE'),
('10', '01', '13', 'PACHACUTEC'),
('10', '01', '14', 'OCUCAJE'),
('10', '02', '00', 'CHINCHA'),
('10', '02', '01', 'CHINCHA ALTA'),
('10', '02', '02', 'CHAVIN'),
('10', '02', '03', 'CHINCHA BAJA'),
('10', '02', '04', 'EL CARMEN'),
('10', '02', '05', 'GROCIO PRADO'),
('10', '02', '06', 'SAN PEDRO DE HUACARPANA'),
('10', '02', '07', 'SUNAMPE'),
('10', '02', '08', 'TAMBO DE MORA'),
('10', '02', '09', 'ALTO LARAN'),
('10', '02', '10', 'PUEBLO NUEVO'),
('10', '02', '11', 'SAN JUAN DE YANAC'),
('10', '03', '00', 'NAZCA'),
('10', '03', '01', 'NAZCA'),
('10', '03', '02', 'CHANGUILLO'),
('10', '03', '03', 'EL INGENIO'),
('10', '03', '04', 'MARCONA'),
('10', '03', '05', 'VISTA ALEGRE'),
('10', '04', '00', 'PISCO'),
('10', '04', '01', 'PISCO'),
('10', '04', '02', 'HUANCANO'),
('10', '04', '03', 'HUMAY'),
('10', '04', '04', 'INDEPENDENCIA'),
('10', '04', '05', 'PARACAS'),
('10', '04', '06', 'SAN ANDRES'),
('10', '04', '07', 'SAN CLEMENTE'),
('10', '04', '08', 'TUPAC AMARU INCA'),
('10', '05', '00', 'PALPA'),
('10', '05', '01', 'PALPA'),
('10', '05', '02', 'LLIPATA'),
('10', '05', '03', 'RIO GRANDE'),
('10', '05', '04', 'SANTA CRUZ'),
('10', '05', '05', 'TIBILLO'),
('11', '00', '00', 'JUNIN'),
('11', '01', '00', 'HUANCAYO'),
('11', '01', '01', 'HUANCAYO'),
('11', '01', '03', 'CARHUACALLANGA'),
('11', '01', '04', 'COLCA'),
('11', '01', '05', 'CULLHUAS'),
('11', '01', '06', 'CHACAPAMPA'),
('11', '01', '07', 'CHICCHE'),
('11', '01', '08', 'CHILCA'),
('11', '01', '09', 'CHONGOS ALTO'),
('11', '01', '12', 'CHUPURO'),
('11', '01', '13', 'EL TAMBO'),
('11', '01', '14', 'HUACRAPUQUIO'),
('11', '01', '16', 'HUALHUAS'),
('11', '01', '18', 'HUANCAN'),
('11', '01', '19', 'HUASICANCHA'),
('11', '01', '20', 'HUAYUCACHI'),
('11', '01', '21', 'INGENIO'),
('11', '01', '22', 'PARIAHUANCA'),
('11', '01', '23', 'PILCOMAYO'),
('11', '01', '24', 'PUCARA'),
('11', '01', '25', 'QUICHUAY'),
('11', '01', '26', 'QUILCAS'),
('11', '01', '27', 'SAN AGUSTIN'),
('11', '01', '28', 'SAN JERONIMO DE TUNAN'),
('11', '01', '31', 'SANTO DOMINGO DE ACOBAMBA'),
('11', '01', '32', 'SAÑO'),
('11', '01', '33', 'SAPALLANGA'),
('11', '01', '34', 'SICAYA'),
('11', '01', '36', 'VIQUES'),
('11', '02', '00', 'CONCEPCION'),
('11', '02', '01', 'CONCEPCION'),
('11', '02', '02', 'ACO'),
('11', '02', '03', 'ANDAMARCA'),
('11', '02', '04', 'COMAS'),
('11', '02', '05', 'COCHAS'),
('11', '02', '06', 'CHAMBARA'),
('11', '02', '07', 'HEROINAS TOLEDO'),
('11', '02', '08', 'MANZANARES'),
('11', '02', '09', 'MARISCAL CASTILLA'),
('11', '02', '10', 'MATAHUASI'),
('11', '02', '11', 'MITO'),
('11', '02', '12', 'NUEVE DE JULIO'),
('11', '02', '13', 'ORCOTUNA'),
('11', '02', '14', 'SANTA ROSA DE OCOPA'),
('11', '02', '15', 'SAN JOSE DE QUERO'),
('11', '03', '00', 'JAUJA'),
('11', '03', '01', 'JAUJA'),
('11', '03', '02', 'ACOLLA'),
('11', '03', '03', 'APATA'),
('11', '03', '04', 'ATAURA'),
('11', '03', '05', 'CANCHAYLLO'),
('11', '03', '06', 'EL MANTARO'),
('11', '03', '07', 'HUAMALI'),
('11', '03', '08', 'HUARIPAMPA'),
('11', '03', '09', 'HUERTAS'),
('11', '03', '10', 'JANJAILLO'),
('11', '03', '11', 'JULCAN'),
('11', '03', '12', 'LEONOR ORDOÑEZ'),
('11', '03', '13', 'LLOCLLAPAMPA'),
('11', '03', '14', 'MARCO'),
('11', '03', '15', 'MASMA'),
('11', '03', '16', 'MOLINOS'),
('11', '03', '17', 'MONOBAMBA'),
('11', '03', '18', 'MUQUI'),
('11', '03', '19', 'MUQUIYAUYO'),
('11', '03', '20', 'PACA'),
('11', '03', '21', 'PACCHA'),
('11', '03', '22', 'PANCAN'),
('11', '03', '23', 'PARCO'),
('11', '03', '24', 'POMACANCHA'),
('11', '03', '25', 'RICRAN'),
('11', '03', '26', 'SAN LORENZO'),
('11', '03', '27', 'SAN PEDRO DE CHUNAN'),
('11', '03', '28', 'SINCOS'),
('11', '03', '29', 'TUNAN MARCA'),
('11', '03', '30', 'YAULI'),
('11', '03', '31', 'CURICACA'),
('11', '03', '32', 'MASMA CHICCHE'),
('11', '03', '33', 'SAUSA'),
('11', '03', '34', 'YAUYOS'),
('11', '04', '00', 'JUNIN'),
('11', '04', '01', 'JUNIN'),
('11', '04', '02', 'CARHUAMAYO'),
('11', '04', '03', 'ONDORES'),
('11', '04', '04', 'ULCUMAYO'),
('11', '05', '00', 'TARMA'),
('11', '05', '01', 'TARMA'),
('11', '05', '02', 'ACOBAMBA'),
('11', '05', '03', 'HUARICOLCA'),
('11', '05', '04', 'HUASAHUASI'),
('11', '05', '05', 'LA UNION'),
('11', '05', '06', 'PALCA'),
('11', '05', '07', 'PALCAMAYO'),
('11', '05', '08', 'SAN PEDRO DE CAJAS'),
('11', '05', '09', 'TAPO'),
('11', '06', '00', 'YAULI'),
('11', '06', '01', 'LA OROYA'),
('11', '06', '02', 'CHACAPALPA'),
('11', '06', '03', 'HUAY HUAY'),
('11', '06', '04', 'MARCAPOMACOCHA'),
('11', '06', '05', 'MOROCOCHA'),
('11', '06', '06', 'PACCHA'),
('11', '06', '07', 'SANTA BARBARA DE CARHUACAYAN'),
('11', '06', '08', 'SUITUCANCHA'),
('11', '06', '09', 'YAULI'),
('11', '06', '10', 'SANTA ROSA DE SACCO'),
('11', '07', '00', 'SATIPO'),
('11', '07', '01', 'SATIPO'),
('11', '07', '02', 'COVIRIALI'),
('11', '07', '03', 'LLAYLLA'),
('11', '07', '04', 'MAZAMARI'),
('11', '07', '05', 'PAMPA HERMOSA'),
('11', '07', '06', 'PANGOA'),
('11', '07', '07', 'RIO NEGRO'),
('11', '07', '08', 'RIO TAMBO'),
('11', '08', '00', 'CHANCHAMAYO'),
('11', '08', '01', 'CHANCHAMAYO'),
('11', '08', '02', 'SAN RAMON'),
('11', '08', '03', 'VITOC'),
('11', '08', '04', 'SAN LUIS DE SHUARO'),
('11', '08', '05', 'PICHANAQUI'),
('11', '08', '06', 'PERENE'),
('11', '09', '00', 'CHUPACA'),
('11', '09', '01', 'CHUPACA'),
('11', '09', '02', 'AHUAC'),
('11', '09', '03', 'CHONGOS BAJO'),
('11', '09', '04', 'HUACHAC'),
('11', '09', '05', 'HUAMANCACA CHICO'),
('11', '09', '06', 'SAN JUAN DE YSCOS'),
('11', '09', '07', 'SAN JUAN DE JARPA'),
('11', '09', '08', 'TRES DE DICIEMBRE'),
('11', '09', '09', 'YANACANCHA'),
('12', '00', '00', 'LA LIBERTAD'),
('12', '01', '00', 'TRUJILLO'),
('12', '01', '01', 'TRUJILLO'),
('12', '01', '02', 'HUANCHACO'),
('12', '01', '03', 'LAREDO'),
('12', '01', '04', 'MOCHE'),
('12', '01', '05', 'SALAVERRY'),
('12', '01', '06', 'SIMBAL'),
('12', '01', '07', 'VICTOR LARCO HERRERA'),
('12', '01', '09', 'POROTO'),
('12', '01', '10', 'EL PORVENIR'),
('12', '01', '11', 'LA ESPERANZA'),
('12', '01', '12', 'FLORENCIA DE MORA'),
('12', '02', '00', 'BOLIVAR'),
('12', '02', '01', 'BOLIVAR'),
('12', '02', '02', 'BAMBAMARCA'),
('12', '02', '03', 'CONDORMARCA'),
('12', '02', '04', 'LONGOTEA'),
('12', '02', '05', 'UCUNCHA'),
('12', '02', '06', 'UCHUMARCA'),
('12', '03', '00', 'SANCHEZ CARRION'),
('12', '03', '01', 'HUAMACHUCO'),
('12', '03', '02', 'COCHORCO'),
('12', '03', '03', 'CURGOS'),
('12', '03', '04', 'CHUGAY'),
('12', '03', '05', 'MARCABAL'),
('12', '03', '06', 'SANAGORAN'),
('12', '03', '07', 'SARIN'),
('12', '03', '08', 'SARTIMBAMBA'),
('12', '04', '00', 'OTUZCO'),
('12', '04', '01', 'OTUZCO'),
('12', '04', '02', 'AGALLPAMPA'),
('12', '04', '03', 'CHARAT'),
('12', '04', '04', 'HUARANCHAL'),
('12', '04', '05', 'LA CUESTA'),
('12', '04', '08', 'PARANDAY'),
('12', '04', '09', 'SALPO'),
('12', '04', '10', 'SINSICAP'),
('12', '04', '11', 'USQUIL'),
('12', '04', '13', 'MACHE'),
('12', '05', '00', 'PACASMAYO'),
('12', '05', '01', 'SAN PEDRO DE LLOC'),
('12', '05', '03', 'GUADALUPE'),
('12', '05', '04', 'JEQUETEPEQUE'),
('12', '05', '06', 'PACASMAYO'),
('12', '05', '08', 'SAN JOSE'),
('12', '06', '00', 'PATAZ'),
('12', '06', '01', 'TAYABAMBA'),
('12', '06', '02', 'BULDIBUYO'),
('12', '06', '03', 'CHILLIA'),
('12', '06', '04', 'HUAYLILLAS'),
('12', '06', '05', 'HUANCASPATA'),
('12', '06', '06', 'HUAYO'),
('12', '06', '07', 'ONGON'),
('12', '06', '08', 'PARCOY'),
('12', '06', '09', 'PATAZ'),
('12', '06', '10', 'PIAS'),
('12', '06', '11', 'TAURIJA'),
('12', '06', '12', 'URPAY'),
('12', '06', '13', 'SANTIAGO DE CHALLAS'),
('12', '07', '00', 'SANTIAGO DE CHUCO'),
('12', '07', '01', 'SANTIAGO DE CHUCO'),
('12', '07', '02', 'CACHICADAN'),
('12', '07', '03', 'MOLLEBAMBA'),
('12', '07', '04', 'MOLLEPATA'),
('12', '07', '05', 'QUIRUVILCA'),
('12', '07', '06', 'SANTA CRUZ DE CHUCA'),
('12', '07', '07', 'SITABAMBA'),
('12', '07', '08', 'ANGASMARCA'),
('12', '08', '00', 'ASCOPE'),
('12', '08', '01', 'ASCOPE'),
('12', '08', '02', 'CHICAMA'),
('12', '08', '03', 'CHOCOPE'),
('12', '08', '04', 'SANTIAGO DE CAO'),
('12', '08', '05', 'MAGDALENA DE CAO'),
('12', '08', '06', 'PAIJAN'),
('12', '08', '07', 'RAZURI'),
('12', '08', '08', 'CASA GRANDE'),
('12', '09', '00', 'CHEPEN'),
('12', '09', '01', 'CHEPEN'),
('12', '09', '02', 'PACANGA'),
('12', '09', '03', 'PUEBLO NUEVO'),
('12', '10', '00', 'JULCAN'),
('12', '10', '01', 'JULCAN'),
('12', '10', '02', 'CARABAMBA'),
('12', '10', '03', 'CALAMARCA'),
('12', '10', '04', 'HUASO'),
('12', '11', '00', 'GRAN CHIMU'),
('12', '11', '01', 'CASCAS'),
('12', '11', '02', 'LUCMA'),
('12', '11', '03', 'MARMOT'),
('12', '11', '04', 'SAYAPULLO'),
('12', '12', '00', 'VIRU'),
('12', '12', '01', 'VIRU'),
('12', '12', '02', 'CHAO'),
('12', '12', '03', 'GUADALUPITO'),
('13', '00', '00', 'LAMBAYEQUE'),
('13', '01', '00', 'CHICLAYO'),
('13', '01', '01', 'CHICLAYO'),
('13', '01', '02', 'CHONGOYAPE'),
('13', '01', '03', 'ETEN'),
('13', '01', '04', 'ETEN PUERTO'),
('13', '01', '05', 'LAGUNAS'),
('13', '01', '06', 'MONSEFU'),
('13', '01', '07', 'NUEVA ARICA'),
('13', '01', '08', 'OYOTUN'),
('13', '01', '09', 'PICSI'),
('13', '01', '10', 'PIMENTEL'),
('13', '01', '11', 'REQUE'),
('13', '01', '12', 'JOSE LEONARDO ORTIZ'),
('13', '01', '13', 'SANTA ROSA'),
('13', '01', '14', 'SAÑA'),
('13', '01', '15', 'LA VICTORIA'),
('13', '01', '16', 'CAYALTI'),
('13', '01', '17', 'PATAPO'),
('13', '01', '18', 'POMALCA'),
('13', '01', '19', 'PUCALA'),
('13', '01', '20', 'TUMAN'),
('13', '02', '00', 'FERREÑAFE'),
('13', '02', '01', 'FERREÑAFE'),
('13', '02', '02', 'INCAHUASI'),
('13', '02', '03', 'CAÑARIS'),
('13', '02', '04', 'PITIPO'),
('13', '02', '05', 'PUEBLO NUEVO'),
('13', '02', '06', 'MANUEL ANTONIO MESONES MURO'),
('13', '03', '00', 'LAMBAYEQUE'),
('13', '03', '01', 'LAMBAYEQUE'),
('13', '03', '02', 'CHOCHOPE'),
('13', '03', '03', 'ILLIMO'),
('13', '03', '04', 'JAYANCA'),
('13', '03', '05', 'MOCHUMI'),
('13', '03', '06', 'MORROPE'),
('13', '03', '07', 'MOTUPE'),
('13', '03', '08', 'OLMOS'),
('13', '03', '09', 'PACORA'),
('13', '03', '10', 'SALAS'),
('13', '03', '11', 'SAN JOSE'),
('13', '03', '12', 'TUCUME'),
('14', '00', '00', 'LIMA'),
('14', '01', '00', 'LIMA'),
('14', '01', '01', 'LIMA'),
('14', '01', '02', 'ANCON'),
('14', '01', '03', 'ATE'),
('14', '01', '04', 'BREÑA'),
('14', '01', '05', 'CARABAYLLO'),
('14', '01', '06', 'COMAS'),
('14', '01', '07', 'CHACLACAYO'),
('14', '01', '08', 'CHORRILLOS'),
('14', '01', '09', 'LA VICTORIA'),
('14', '01', '10', 'LA MOLINA'),
('14', '01', '11', 'LINCE'),
('14', '01', '12', 'LURIGANCHO'),
('14', '01', '13', 'LURIN'),
('14', '01', '14', 'MAGDALENA DEL MAR'),
('14', '01', '15', 'MIRAFLORES'),
('14', '01', '16', 'PACHACAMAC'),
('14', '01', '17', 'PUEBLO LIBRE'),
('14', '01', '18', 'PUCUSANA'),
('14', '01', '19', 'PUENTE PIEDRA'),
('14', '01', '20', 'PUNTA HERMOSA'),
('14', '01', '21', 'PUNTA NEGRA'),
('14', '01', '22', 'RIMAC'),
('14', '01', '23', 'SAN BARTOLO'),
('14', '01', '24', 'SAN ISIDRO'),
('14', '01', '25', 'BARRANCO'),
('14', '01', '26', 'SAN MARTIN DE PORRES'),
('14', '01', '27', 'SAN MIGUEL'),
('14', '01', '28', 'SANTA MARIA DEL MAR'),
('14', '01', '29', 'SANTA ROSA'),
('14', '01', '30', 'SANTIAGO DE SURCO'),
('14', '01', '31', 'SURQUILLO'),
('14', '01', '32', 'VILLA MARIA DEL TRIUNFO'),
('14', '01', '33', 'JESUS MARIA'),
('14', '01', '34', 'INDEPENDENCIA'),
('14', '01', '35', 'EL AGUSTINO'),
('14', '01', '36', 'SAN JUAN DE MIRAFLORES'),
('14', '01', '37', 'SAN JUAN DE LURIGANCHO'),
('14', '01', '38', 'SAN LUIS'),
('14', '01', '39', 'CIENEGUILLA'),
('14', '01', '40', 'SAN BORJA'),
('14', '01', '41', 'VILLA EL SALVADOR'),
('14', '01', '42', 'LOS OLIVOS'),
('14', '01', '43', 'SANTA ANITA'),
('14', '02', '00', 'CAJATAMBO'),
('14', '02', '01', 'CAJATAMBO'),
('14', '02', '05', 'COPA'),
('14', '02', '06', 'GORGOR'),
('14', '02', '07', 'HUANCAPON'),
('14', '02', '08', 'MANAS'),
('14', '03', '00', 'CANTA'),
('14', '03', '01', 'CANTA'),
('14', '03', '02', 'ARAHUAY'),
('14', '03', '03', 'HUAMANTANGA'),
('14', '03', '04', 'HUAROS'),
('14', '03', '05', 'LACHAQUI'),
('14', '03', '06', 'SAN BUENAVENTURA'),
('14', '03', '07', 'SANTA ROSA DE QUIVES'),
('14', '04', '00', 'CAÑETE'),
('14', '04', '01', 'SAN VICENTE DE CAÑETE'),
('14', '04', '02', 'CALANGO'),
('14', '04', '03', 'CERRO AZUL'),
('14', '04', '04', 'COAYLLO'),
('14', '04', '05', 'CHILCA'),
('14', '04', '06', 'IMPERIAL'),
('14', '04', '07', 'LUNAHUANA'),
('14', '04', '08', 'MALA'),
('14', '04', '09', 'NUEVO IMPERIAL'),
('14', '04', '10', 'PACARAN'),
('14', '04', '11', 'QUILMANA'),
('14', '04', '12', 'SAN ANTONIO'),
('14', '04', '13', 'SAN LUIS'),
('14', '04', '14', 'SANTA CRUZ DE FLORES'),
('14', '04', '15', 'ZUÑIGA'),
('14', '04', '16', 'ASIA'),
('14', '05', '00', 'HUAURA'),
('14', '05', '01', 'HUACHO'),
('14', '05', '02', 'AMBAR'),
('14', '05', '04', 'CALETA DE CARQUIN'),
('14', '05', '05', 'CHECRAS'),
('14', '05', '06', 'HUALMAY'),
('14', '05', '07', 'HUAURA'),
('14', '05', '08', 'LEONCIO PRADO'),
('14', '05', '09', 'PACCHO'),
('14', '05', '11', 'SANTA LEONOR'),
('14', '05', '12', 'SANTA MARIA'),
('14', '05', '13', 'SAYAN'),
('14', '05', '16', 'VEGUETA'),
('14', '06', '00', 'HUAROCHIRI'),
('14', '06', '01', 'MATUCANA'),
('14', '06', '02', 'ANTIOQUIA'),
('14', '06', '03', 'CALLAHUANCA'),
('14', '06', '04', 'CARAMPOMA'),
('14', '06', '05', 'CASTA'),
('14', '06', '06', 'SAN JOSE DE LOS CHORRILLOS'),
('14', '06', '07', 'CHICLA'),
('14', '06', '08', 'HUANZA'),
('14', '06', '09', 'HUAROCHIRI'),
('14', '06', '10', 'LAHUAYTAMBO'),
('14', '06', '11', 'LANGA'),
('14', '06', '12', 'MARIATANA'),
('14', '06', '13', 'RICARDO PALMA'),
('14', '06', '14', 'SAN ANDRES DE TUPICOCHA'),
('14', '06', '15', 'SAN ANTONIO'),
('14', '06', '16', 'SAN BARTOLOME'),
('14', '06', '17', 'SAN DAMIAN'),
('14', '06', '18', 'SANGALLAYA'),
('14', '06', '19', 'SAN JUAN DE TANTARANCHE'),
('14', '06', '20', 'SAN LORENZO DE QUINTI'),
('14', '06', '21', 'SAN MATEO'),
('14', '06', '22', 'SAN MATEO DE OTAO'),
('14', '06', '23', 'SAN PEDRO DE HUANCAYRE'),
('14', '06', '24', 'SANTA CRUZ DE COCACHACRA'),
('14', '06', '25', 'SANTA EULALIA'),
('14', '06', '26', 'SANTIAGO DE ANCHUCAYA'),
('14', '06', '27', 'SANTIAGO DE TUNA'),
('14', '06', '28', 'SANTO DOMINGO DE LOS OLLEROS'),
('14', '06', '29', 'SURCO'),
('14', '06', '30', 'HUACHUPAMPA'),
('14', '06', '31', 'LARAOS'),
('14', '06', '32', 'SAN JUAN DE IRIS'),
('14', '07', '00', 'YAUYOS'),
('14', '07', '01', 'YAUYOS'),
('14', '07', '02', 'ALIS'),
('14', '07', '03', 'ALLAUCA'),
('14', '07', '04', 'AYAVIRI'),
('14', '07', '05', 'AZANGARO'),
('14', '07', '06', 'CACRA'),
('14', '07', '07', 'CARANIA'),
('14', '07', '08', 'COCHAS'),
('14', '07', '09', 'COLONIA'),
('14', '07', '10', 'CHOCOS'),
('14', '07', '11', 'HUAMPARA'),
('14', '07', '12', 'HUANCAYA'),
('14', '07', '13', 'HUANGASCAR'),
('14', '07', '14', 'HUANTAN'),
('14', '07', '15', 'HUAÑEC'),
('14', '07', '16', 'LARAOS'),
('14', '07', '17', 'LINCHA'),
('14', '07', '18', 'MIRAFLORES'),
('14', '07', '19', 'OMAS'),
('14', '07', '20', 'QUINCHES'),
('14', '07', '21', 'QUINOCAY'),
('14', '07', '22', 'SAN JOAQUIN'),
('14', '07', '23', 'SAN PEDRO DE PILAS'),
('14', '07', '24', 'TANTA'),
('14', '07', '25', 'TAURIPAMPA'),
('14', '07', '26', 'TUPE'),
('14', '07', '27', 'TOMAS'),
('14', '07', '28', 'VIÑAC'),
('14', '07', '29', 'VITIS'),
('14', '07', '30', 'HONGOS'),
('14', '07', '31', 'MADEAN'),
('14', '07', '32', 'PUTINZA'),
('14', '07', '33', 'CATAHUASI'),
('14', '08', '00', 'HUARAL'),
('14', '08', '01', 'HUARAL'),
('14', '08', '02', 'ATAVILLOS ALTO'),
('14', '08', '03', 'ATAVILLOS BAJO'),
('14', '08', '04', 'AUCALLAMA'),
('14', '08', '05', 'CHANCAY'),
('14', '08', '06', 'IHUARI'),
('14', '08', '07', 'LAMPIAN'),
('14', '08', '08', 'PACARAOS'),
('14', '08', '09', 'SAN MIGUEL DE ACOS'),
('14', '08', '10', 'VEINTISIETE DE NOVIEMBRE'),
('14', '08', '11', 'SANTA CRUZ DE ANDAMARCA'),
('14', '08', '12', 'SUMBILCA'),
('14', '09', '00', 'BARRANCA'),
('14', '09', '01', 'BARRANCA'),
('14', '09', '02', 'PARAMONGA'),
('14', '09', '03', 'PATIVILCA'),
('14', '09', '04', 'SUPE'),
('14', '09', '05', 'SUPE PUERTO'),
('14', '10', '00', 'OYON'),
('14', '10', '01', 'OYON'),
('14', '10', '02', 'NAVAN'),
('14', '10', '03', 'CAUJUL'),
('14', '10', '04', 'ANDAJES'),
('14', '10', '05', 'PACHANGARA'),
('14', '10', '06', 'COCHAMARCA'),
('15', '00', '00', 'LORETO'),
('15', '01', '00', 'MAYNAS'),
('15', '01', '01', 'IQUITOS'),
('15', '01', '02', 'ALTO NANAY'),
('15', '01', '03', 'FERNANDO LORES'),
('15', '01', '04', 'LAS AMAZONAS'),
('15', '01', '05', 'MAZAN'),
('15', '01', '06', 'NAPO'),
('15', '01', '07', 'PUTUMAYO'),
('15', '01', '08', 'TORRES CAUSANA'),
('15', '01', '10', 'INDIANA'),
('15', '01', '11', 'PUNCHANA'),
('15', '01', '12', 'BELEN'),
('15', '01', '13', 'SAN JUAN BAUTISTA'),
('15', '01', '14', 'TENIENTE MANUEL CLAVERO'),
('15', '02', '00', 'ALTO AMAZONAS'),
('15', '02', '01', 'YURIMAGUAS'),
('15', '02', '02', 'BALSAPUERTO'),
('15', '02', '05', 'JEBEROS'),
('15', '02', '06', 'LAGUNAS'),
('15', '02', '10', 'SANTA CRUZ'),
('15', '02', '11', 'TENIENTE CESAR LOPEZ ROJAS'),
('15', '03', '00', 'LORETO'),
('15', '03', '01', 'NAUTA'),
('15', '03', '02', 'PARINARI'),
('15', '03', '03', 'TIGRE'),
('15', '03', '04', 'URARINAS'),
('15', '03', '05', 'TROMPETEROS'),
('15', '04', '00', 'REQUENA'),
('15', '04', '01', 'REQUENA'),
('15', '04', '02', 'ALTO TAPICHE'),
('15', '04', '03', 'CAPELO'),
('15', '04', '04', 'EMILIO SAN MARTIN'),
('15', '04', '05', 'MAQUIA'),
('15', '04', '06', 'PUINAHUA'),
('15', '04', '07', 'SAQUENA'),
('15', '04', '08', 'SOPLIN');
INSERT INTO `ubigeo` (`cc_departamento`, `provincia`, `distrito`, `nombre`) VALUES
('15', '04', '09', 'TAPICHE'),
('15', '04', '10', 'JENARO HERRERA'),
('15', '04', '11', 'YAQUERANA'),
('15', '05', '00', 'UCAYALI'),
('15', '05', '01', 'CONTAMANA'),
('15', '05', '02', 'VARGAS GUERRA'),
('15', '05', '03', 'PADRE MARQUEZ'),
('15', '05', '04', 'PAMPA HERMOSA'),
('15', '05', '05', 'SARAYACU'),
('15', '05', '06', 'INAHUAYA'),
('15', '06', '00', 'MARISCAL RAMON CASTILLA'),
('15', '06', '01', 'RAMON CASTILLA'),
('15', '06', '02', 'PEBAS'),
('15', '06', '03', 'YAVARI'),
('15', '06', '04', 'SAN PABLO'),
('15', '07', '00', 'DATEM DEL MARAÑON'),
('15', '07', '01', 'BARRANCA'),
('15', '07', '02', 'ANDOAS'),
('15', '07', '03', 'CAHUAPANAS'),
('15', '07', '04', 'MANSERICHE'),
('15', '07', '05', 'MORONA'),
('15', '07', '06', 'PASTAZA'),
('16', '00', '00', 'MADRE DE DIOS'),
('16', '01', '00', 'TAMBOPATA'),
('16', '01', '01', 'TAMBOPATA'),
('16', '01', '02', 'INAMBARI'),
('16', '01', '03', 'LAS PIEDRAS'),
('16', '01', '04', 'LABERINTO'),
('16', '02', '00', 'MANU'),
('16', '02', '01', 'MANU'),
('16', '02', '02', 'FITZCARRALD'),
('16', '02', '03', 'MADRE DE DIOS'),
('16', '02', '04', 'HUEPETUHE'),
('16', '03', '00', 'TAHUAMANU'),
('16', '03', '01', 'IÑAPARI'),
('16', '03', '02', 'IBERIA'),
('16', '03', '03', 'TAHUAMANU'),
('17', '00', '00', 'MOQUEGUA'),
('17', '01', '00', 'MARISCAL NIETO'),
('17', '01', '01', 'MOQUEGUA'),
('17', '01', '02', 'CARUMAS'),
('17', '01', '03', 'CUCHUMBAYA'),
('17', '01', '04', 'SAN CRISTOBAL'),
('17', '01', '05', 'TORATA'),
('17', '01', '06', 'SAMEGUA'),
('17', '02', '00', 'GENERAL SANCHEZ CERRO'),
('17', '02', '01', 'OMATE'),
('17', '02', '02', 'COALAQUE'),
('17', '02', '03', 'CHOJATA'),
('17', '02', '04', 'ICHUÑA'),
('17', '02', '05', 'LA CAPILLA'),
('17', '02', '06', 'LLOQUE'),
('17', '02', '07', 'MATALAQUE'),
('17', '02', '08', 'PUQUINA'),
('17', '02', '09', 'QUINISTAQUILLAS'),
('17', '02', '10', 'UBINAS'),
('17', '02', '11', 'YUNGA'),
('17', '03', '00', 'ILO'),
('17', '03', '01', 'ILO'),
('17', '03', '02', 'EL ALGARROBAL'),
('17', '03', '03', 'PACOCHA'),
('18', '00', '00', 'PASCO'),
('18', '01', '00', 'PASCO'),
('18', '01', '01', 'CHAUPIMARCA'),
('18', '01', '03', 'HUACHON'),
('18', '01', '04', 'HUARIACA'),
('18', '01', '05', 'HUAYLLAY'),
('18', '01', '06', 'NINACACA'),
('18', '01', '07', 'PALLANCHACRA'),
('18', '01', '08', 'PAUCARTAMBO'),
('18', '01', '09', 'SAN FCO DE ASIS DE YARUSYACAN'),
('18', '01', '10', 'SIMON BOLIVAR'),
('18', '01', '11', 'TICLACAYAN'),
('18', '01', '12', 'TINYAHUARCO'),
('18', '01', '13', 'VICCO'),
('18', '01', '14', 'YANACANCHA'),
('18', '02', '00', 'DANIEL ALCIDES CARRION'),
('18', '02', '01', 'YANAHUANCA'),
('18', '02', '02', 'CHACAYAN'),
('18', '02', '03', 'GOYLLARISQUIZGA'),
('18', '02', '04', 'PAUCAR'),
('18', '02', '05', 'SAN PEDRO DE PILLAO'),
('18', '02', '06', 'SANTA ANA DE TUSI'),
('18', '02', '07', 'TAPUC'),
('18', '02', '08', 'VILCABAMBA'),
('18', '03', '00', 'OXAPAMPA'),
('18', '03', '01', 'OXAPAMPA'),
('18', '03', '02', 'CHONTABAMBA'),
('18', '03', '03', 'HUANCABAMBA'),
('18', '03', '04', 'PUERTO BERMUDEZ'),
('18', '03', '05', 'VILLA RICA'),
('18', '03', '06', 'POZUZO'),
('18', '03', '07', 'PALCAZU'),
('18', '03', '08', 'CONSTITUCION'),
('19', '00', '00', 'PIURA'),
('19', '01', '00', 'PIURA'),
('19', '01', '01', 'PIURA'),
('19', '01', '03', 'CASTILLA'),
('19', '01', '04', 'CATACAOS'),
('19', '01', '05', 'LA ARENA'),
('19', '01', '06', 'LA UNION'),
('19', '01', '07', 'LAS LOMAS'),
('19', '01', '09', 'TAMBO GRANDE'),
('19', '01', '13', 'CURA MORI'),
('19', '01', '14', 'EL TALLAN'),
('19', '01', '15', 'VEINTISEIS DE OCTUBRE'),
('19', '02', '00', 'AYABACA'),
('19', '02', '01', 'AYABACA'),
('19', '02', '02', 'FRIAS'),
('19', '02', '03', 'LAGUNAS'),
('19', '02', '04', 'MONTERO'),
('19', '02', '05', 'PACAIPAMPA'),
('19', '02', '06', 'SAPILLICA'),
('19', '02', '07', 'SICCHEZ'),
('19', '02', '08', 'SUYO'),
('19', '02', '09', 'JILILI'),
('19', '02', '10', 'PAIMAS'),
('19', '03', '00', 'HUANCABAMBA'),
('19', '03', '01', 'HUANCABAMBA'),
('19', '03', '02', 'CANCHAQUE'),
('19', '03', '03', 'HUARMACA'),
('19', '03', '04', 'SONDOR'),
('19', '03', '05', 'SONDORILLO'),
('19', '03', '06', 'EL CARMEN DE LA FRONTERA'),
('19', '03', '07', 'SAN MIGUEL DE EL FAIQUE'),
('19', '03', '08', 'LALAQUIZ'),
('19', '04', '00', 'MORROPON'),
('19', '04', '01', 'CHULUCANAS'),
('19', '04', '02', 'BUENOS AIRES'),
('19', '04', '03', 'CHALACO'),
('19', '04', '04', 'MORROPON'),
('19', '04', '05', 'SALITRAL'),
('19', '04', '06', 'SANTA CATALINA DE MOSSA'),
('19', '04', '07', 'SANTO DOMINGO'),
('19', '04', '08', 'LA MATANZA'),
('19', '04', '09', 'YAMANGO'),
('19', '04', '10', 'SAN JUAN DE BIGOTE'),
('19', '05', '00', 'PAITA'),
('19', '05', '01', 'PAITA'),
('19', '05', '02', 'AMOTAPE'),
('19', '05', '03', 'ARENAL'),
('19', '05', '04', 'LA HUACA'),
('19', '05', '05', 'COLAN'),
('19', '05', '06', 'TAMARINDO'),
('19', '05', '07', 'VICHAYAL'),
('19', '06', '00', 'SULLANA'),
('19', '06', '01', 'SULLANA'),
('19', '06', '02', 'BELLAVISTA'),
('19', '06', '03', 'LANCONES'),
('19', '06', '04', 'MARCAVELICA'),
('19', '06', '05', 'MIGUEL CHECA'),
('19', '06', '06', 'QUERECOTILLO'),
('19', '06', '07', 'SALITRAL'),
('19', '06', '08', 'IGNACIO ESCUDERO'),
('19', '07', '00', 'TALARA'),
('19', '07', '01', 'PARIÑAS'),
('19', '07', '02', 'EL ALTO'),
('19', '07', '03', 'LA BREA'),
('19', '07', '04', 'LOBITOS'),
('19', '07', '05', 'MANCORA'),
('19', '07', '06', 'LOS ORGANOS'),
('19', '08', '00', 'SECHURA'),
('19', '08', '01', 'SECHURA'),
('19', '08', '02', 'VICE'),
('19', '08', '03', 'BERNAL'),
('19', '08', '04', 'BELLAVISTA DE LA UNION'),
('19', '08', '05', 'CRISTO NOS VALGA'),
('19', '08', '06', 'RINCONADA-LLICUAR'),
('20', '00', '00', 'PUNO'),
('20', '01', '00', 'PUNO'),
('20', '01', '01', 'PUNO'),
('20', '01', '02', 'ACORA'),
('20', '01', '03', 'ATUNCOLLA'),
('20', '01', '04', 'CAPACHICA'),
('20', '01', '05', 'COATA'),
('20', '01', '06', 'CHUCUITO'),
('20', '01', '07', 'HUATA'),
('20', '01', '08', 'MAÑAZO'),
('20', '01', '09', 'PAUCARCOLLA'),
('20', '01', '10', 'PICHACANI'),
('20', '01', '11', 'SAN ANTONIO'),
('20', '01', '12', 'TIQUILLACA'),
('20', '01', '13', 'VILQUE'),
('20', '01', '14', 'PLATERIA'),
('20', '01', '15', 'AMANTANI'),
('20', '02', '00', 'AZANGARO'),
('20', '02', '01', 'AZANGARO'),
('20', '02', '02', 'ACHAYA'),
('20', '02', '03', 'ARAPA'),
('20', '02', '04', 'ASILLO'),
('20', '02', '05', 'CAMINACA'),
('20', '02', '06', 'CHUPA'),
('20', '02', '07', 'JOSE DOMINGO CHOQUEHUANCA'),
('20', '02', '08', 'MUÑANI'),
('20', '02', '10', 'POTONI'),
('20', '02', '12', 'SAMAN'),
('20', '02', '13', 'SAN ANTON'),
('20', '02', '14', 'SAN JOSE'),
('20', '02', '15', 'SAN JUAN DE SALINAS'),
('20', '02', '16', 'SANTIAGO DE PUPUJA'),
('20', '02', '17', 'TIRAPATA'),
('20', '03', '00', 'CARABAYA'),
('20', '03', '01', 'MACUSANI'),
('20', '03', '02', 'AJOYANI'),
('20', '03', '03', 'AYAPATA'),
('20', '03', '04', 'COASA'),
('20', '03', '05', 'CORANI'),
('20', '03', '06', 'CRUCERO'),
('20', '03', '07', 'ITUATA'),
('20', '03', '08', 'OLLACHEA'),
('20', '03', '09', 'SAN GABAN'),
('20', '03', '10', 'USICAYOS'),
('20', '04', '00', 'CHUCUITO'),
('20', '04', '01', 'JULI'),
('20', '04', '02', 'DESAGUADERO'),
('20', '04', '03', 'HUACULLANI'),
('20', '04', '06', 'PISACOMA'),
('20', '04', '07', 'POMATA'),
('20', '04', '10', 'ZEPITA'),
('20', '04', '12', 'KELLUYO'),
('20', '05', '00', 'HUANCANE'),
('20', '05', '01', 'HUANCANE'),
('20', '05', '02', 'COJATA'),
('20', '05', '04', 'INCHUPALLA'),
('20', '05', '06', 'PUSI'),
('20', '05', '07', 'ROSASPATA'),
('20', '05', '08', 'TARACO'),
('20', '05', '09', 'VILQUE CHICO'),
('20', '05', '11', 'HUATASANI'),
('20', '06', '00', 'LAMPA'),
('20', '06', '01', 'LAMPA'),
('20', '06', '02', 'CABANILLA'),
('20', '06', '03', 'CALAPUJA'),
('20', '06', '04', 'NICASIO'),
('20', '06', '05', 'OCUVIRI'),
('20', '06', '06', 'PALCA'),
('20', '06', '07', 'PARATIA'),
('20', '06', '08', 'PUCARA'),
('20', '06', '09', 'SANTA LUCIA'),
('20', '06', '10', 'VILAVILA'),
('20', '07', '00', 'MELGAR'),
('20', '07', '01', 'AYAVIRI'),
('20', '07', '02', 'ANTAUTA'),
('20', '07', '03', 'CUPI'),
('20', '07', '04', 'LLALLI'),
('20', '07', '05', 'MACARI'),
('20', '07', '06', 'NUÑOA'),
('20', '07', '07', 'ORURILLO'),
('20', '07', '08', 'SANTA ROSA'),
('20', '07', '09', 'UMACHIRI'),
('20', '08', '00', 'SANDIA'),
('20', '08', '01', 'SANDIA'),
('20', '08', '03', 'CUYOCUYO'),
('20', '08', '04', 'LIMBANI'),
('20', '08', '05', 'PHARA'),
('20', '08', '06', 'PATAMBUCO'),
('20', '08', '07', 'QUIACA'),
('20', '08', '08', 'SAN JUAN DEL ORO'),
('20', '08', '10', 'YANAHUAYA'),
('20', '08', '11', 'ALTO INAMBARI'),
('20', '08', '12', 'SAN PEDRO DE PUTINA PUNCO'),
('20', '09', '00', 'SAN ROMAN'),
('20', '09', '01', 'JULIACA'),
('20', '09', '02', 'CABANA'),
('20', '09', '03', 'CABANILLAS'),
('20', '09', '04', 'CARACOTO'),
('20', '10', '00', 'YUNGUYO'),
('20', '10', '01', 'YUNGUYO'),
('20', '10', '02', 'UNICACHI'),
('20', '10', '03', 'ANAPIA'),
('20', '10', '04', 'COPANI'),
('20', '10', '05', 'CUTURAPI'),
('20', '10', '06', 'OLLARAYA'),
('20', '10', '07', 'TINICACHI'),
('20', '11', '00', 'SAN ANTONIO DE PUTINA'),
('20', '11', '01', 'PUTINA'),
('20', '11', '02', 'PEDRO VILCA APAZA'),
('20', '11', '03', 'QUILCAPUNCU'),
('20', '11', '04', 'ANANEA'),
('20', '11', '05', 'SINA'),
('20', '12', '00', 'EL COLLAO'),
('20', '12', '01', 'ILAVE'),
('20', '12', '02', 'PILCUYO'),
('20', '12', '03', 'SANTA ROSA'),
('20', '12', '04', 'CAPASO'),
('20', '12', '05', 'CONDURIRI'),
('20', '13', '00', 'MOHO'),
('20', '13', '01', 'MOHO'),
('20', '13', '02', 'CONIMA'),
('20', '13', '03', 'TILALI'),
('20', '13', '04', 'HUAYRAPATA'),
('21', '00', '00', 'SAN MARTIN'),
('21', '01', '00', 'MOYOBAMBA'),
('21', '01', '01', 'MOYOBAMBA'),
('21', '01', '02', 'CALZADA'),
('21', '01', '03', 'HABANA'),
('21', '01', '04', 'JEPELACIO'),
('21', '01', '05', 'SORITOR'),
('21', '01', '06', 'YANTALO'),
('21', '02', '00', 'HUALLAGA'),
('21', '02', '01', 'SAPOSOA'),
('21', '02', '02', 'PISCOYACU'),
('21', '02', '03', 'SACANCHE'),
('21', '02', '04', 'TINGO DE SAPOSOA'),
('21', '02', '05', 'ALTO SAPOSOA'),
('21', '02', '06', 'EL ESLABON'),
('21', '03', '00', 'LAMAS'),
('21', '03', '01', 'LAMAS'),
('21', '03', '03', 'BARRANQUITA'),
('21', '03', '04', 'CAYNARACHI'),
('21', '03', '05', 'CUÑUMBUQUI'),
('21', '03', '06', 'PINTO RECODO'),
('21', '03', '07', 'RUMISAPA'),
('21', '03', '11', 'SHANAO'),
('21', '03', '13', 'TABALOSOS'),
('21', '03', '14', 'ZAPATERO'),
('21', '03', '15', 'ALONSO DE ALVARADO'),
('21', '03', '16', 'SAN ROQUE DE CUMBAZA'),
('21', '04', '00', 'MARISCAL CACERES'),
('21', '04', '01', 'JUANJUI'),
('21', '04', '02', 'CAMPANILLA'),
('21', '04', '03', 'HUICUNGO'),
('21', '04', '04', 'PACHIZA'),
('21', '04', '05', 'PAJARILLO'),
('21', '05', '00', 'RIOJA'),
('21', '05', '01', 'RIOJA'),
('21', '05', '02', 'POSIC'),
('21', '05', '03', 'YORONGOS'),
('21', '05', '04', 'YURACYACU'),
('21', '05', '05', 'NUEVA CAJAMARCA'),
('21', '05', '06', 'ELIAS SOPLIN VARGAS'),
('21', '05', '07', 'SAN FERNANDO'),
('21', '05', '08', 'PARDO MIGUEL'),
('21', '05', '09', 'AWAJUN'),
('21', '06', '00', 'SAN MARTIN'),
('21', '06', '01', 'TARAPOTO'),
('21', '06', '02', 'ALBERTO LEVEAU'),
('21', '06', '04', 'CACATACHI'),
('21', '06', '06', 'CHAZUTA'),
('21', '06', '07', 'CHIPURANA'),
('21', '06', '08', 'EL PORVENIR'),
('21', '06', '09', 'HUIMBAYOC'),
('21', '06', '10', 'JUAN GUERRA'),
('21', '06', '11', 'MORALES'),
('21', '06', '12', 'PAPAPLAYA'),
('21', '06', '16', 'SAN ANTONIO'),
('21', '06', '19', 'SAUCE'),
('21', '06', '20', 'SHAPAJA'),
('21', '06', '21', 'LA BANDA DE SHILCAYO'),
('21', '07', '00', 'BELLAVISTA'),
('21', '07', '01', 'BELLAVISTA'),
('21', '07', '02', 'SAN RAFAEL'),
('21', '07', '03', 'SAN PABLO'),
('21', '07', '04', 'ALTO BIAVO'),
('21', '07', '05', 'HUALLAGA'),
('21', '07', '06', 'BAJO BIAVO'),
('21', '08', '00', 'TOCACHE'),
('21', '08', '01', 'TOCACHE'),
('21', '08', '02', 'NUEVO PROGRESO'),
('21', '08', '03', 'POLVORA'),
('21', '08', '04', 'SHUNTE'),
('21', '08', '05', 'UCHIZA'),
('21', '09', '00', 'PICOTA'),
('21', '09', '01', 'PICOTA'),
('21', '09', '02', 'BUENOS AIRES'),
('21', '09', '03', 'CASPIZAPA'),
('21', '09', '04', 'PILLUANA'),
('21', '09', '05', 'PUCACACA'),
('21', '09', '06', 'SAN CRISTOBAL'),
('21', '09', '07', 'SAN HILARION'),
('21', '09', '08', 'TINGO DE PONASA'),
('21', '09', '09', 'TRES UNIDOS'),
('21', '09', '10', 'SHAMBOYACU'),
('21', '10', '00', 'EL DORADO'),
('21', '10', '01', 'SAN JOSE DE SISA'),
('21', '10', '02', 'AGUA BLANCA'),
('21', '10', '03', 'SHATOJA'),
('21', '10', '04', 'SAN MARTIN'),
('21', '10', '05', 'SANTA ROSA'),
('22', '00', '00', 'TACNA'),
('22', '01', '00', 'TACNA'),
('22', '01', '01', 'TACNA'),
('22', '01', '02', 'CALANA'),
('22', '01', '04', 'INCLAN'),
('22', '01', '07', 'PACHIA'),
('22', '01', '08', 'PALCA'),
('22', '01', '09', 'POCOLLAY'),
('22', '01', '10', 'SAMA'),
('22', '01', '11', 'ALTO DE LA ALIANZA'),
('22', '01', '12', 'CIUDAD NUEVA'),
('22', '01', '13', 'CORONEL GREGORIO ALBARRACIN L.'),
('22', '02', '00', 'TARATA'),
('22', '02', '01', 'TARATA'),
('22', '02', '05', 'HEROES ALBARRACIN'),
('22', '02', '06', 'ESTIQUE'),
('22', '02', '07', 'ESTIQUE PAMPA'),
('22', '02', '10', 'SITAJARA'),
('22', '02', '11', 'SUSAPAYA'),
('22', '02', '12', 'TARUCACHI'),
('22', '02', '13', 'TICACO'),
('22', '03', '00', 'JORGE BASADRE'),
('22', '03', '01', 'LOCUMBA'),
('22', '03', '02', 'ITE'),
('22', '03', '03', 'ILABAYA'),
('22', '04', '00', 'CANDARAVE'),
('22', '04', '01', 'CANDARAVE'),
('22', '04', '02', 'CAIRANI'),
('22', '04', '03', 'CURIBAYA'),
('22', '04', '04', 'HUANUARA'),
('22', '04', '05', 'QUILAHUANI'),
('22', '04', '06', 'CAMILACA'),
('23', '00', '00', 'TUMBES'),
('23', '01', '00', 'TUMBES'),
('23', '01', '01', 'TUMBES'),
('23', '01', '02', 'CORRALES'),
('23', '01', '03', 'LA CRUZ'),
('23', '01', '04', 'PAMPAS DE HOSPITAL'),
('23', '01', '05', 'SAN JACINTO'),
('23', '01', '06', 'SAN JUAN DE LA VIRGEN'),
('23', '02', '00', 'CONTRALMIRANTE VILLAR'),
('23', '02', '01', 'ZORRITOS'),
('23', '02', '02', 'CASITAS'),
('23', '02', '03', 'CANOAS DE PUNTA SAL'),
('23', '03', '00', 'ZARUMILLA'),
('23', '03', '01', 'ZARUMILLA'),
('23', '03', '02', 'MATAPALO'),
('23', '03', '03', 'PAPAYAL'),
('23', '03', '04', 'AGUAS VERDES'),
('24', '00', '00', 'CALLAO'),
('24', '01', '00', 'CALLAO'),
('24', '01', '01', 'CALLAO'),
('24', '01', '02', 'BELLAVISTA'),
('24', '01', '03', 'LA PUNTA'),
('24', '01', '04', 'CARMEN DE LA LEGUA-REYNOSO'),
('24', '01', '05', 'LA PERLA'),
('24', '01', '06', 'VENTANILLA'),
('25', '00', '00', 'UCAYALI'),
('25', '01', '00', 'CORONEL PORTILLO'),
('25', '01', '01', 'CALLERIA'),
('25', '01', '02', 'YARINACOCHA'),
('25', '01', '03', 'MASISEA'),
('25', '01', '04', 'CAMPOVERDE'),
('25', '01', '05', 'IPARIA'),
('25', '01', '06', 'NUEVA REQUENA'),
('25', '01', '07', 'MANANTAY'),
('25', '02', '00', 'PADRE ABAD'),
('25', '02', '01', 'PADRE ABAD'),
('25', '02', '02', 'IRAZOLA'),
('25', '02', '03', 'CURIMANA'),
('25', '03', '00', 'ATALAYA'),
('25', '03', '01', 'RAIMONDI'),
('25', '03', '02', 'TAHUANIA'),
('25', '03', '03', 'YURUA'),
('25', '03', '04', 'SEPAHUA'),
('25', '04', '00', 'PURUS'),
('25', '04', '01', 'PURUS');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vt_modulo`
--
CREATE TABLE `vt_modulo` (
`mod_id1` varchar(10)
,`mod_id2` varchar(10)
,`mod_id3` varchar(10)
,`mod_nombre` varchar(50)
,`mod_nivel` varchar(10)
,`mod_carpeta` varchar(50)
,`mod_url` varchar(50)
,`mod_img` varchar(50)
,`mod_js` varchar(50)
,`mod_estado` varchar(2)
,`mod_orden` int(11)
,`mod_ico` varchar(50)
,`mod_tipo` varchar(5)
,`mod_tipo_user` varchar(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vt_persona_usuario`
--
CREATE TABLE `vt_persona_usuario` (
`cc_persona` int(10)
,`nombre` varchar(50)
,`fecha_nacimiento` date
,`num_documento` varchar(50)
,`flag_activo` varchar(50)
,`cc_usuario` varchar(10)
,`cc_user` varchar(45)
,`ct_clave` varchar(45)
,`nn_tiempo_sesion` int(11)
,`cfl_acceso` int(2) unsigned
,`df_log` datetime
,`cfl_clave_cambia` int(2) unsigned
,`cc_perfil` int(11)
,`cp_nivel` varchar(5)
,`df_caduca` date
,`flag` varchar(2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vt_modulo`
--
DROP TABLE IF EXISTS `vt_modulo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_modulo`  AS  select `seg_modulo`.`mod_id1` AS `mod_id1`,`seg_modulo`.`mod_id2` AS `mod_id2`,`seg_modulo`.`mod_id3` AS `mod_id3`,`seg_modulo`.`mod_nombre` AS `mod_nombre`,`seg_modulo`.`mod_nivel` AS `mod_nivel`,`seg_modulo`.`mod_carpeta` AS `mod_carpeta`,`seg_modulo`.`mod_url` AS `mod_url`,`seg_modulo`.`mod_img` AS `mod_img`,`seg_modulo`.`mod_js` AS `mod_js`,`seg_modulo`.`mod_estado` AS `mod_estado`,`seg_modulo`.`mod_orden` AS `mod_orden`,`seg_modulo`.`mod_ico` AS `mod_ico`,`seg_modulo`.`mod_tipo` AS `mod_tipo`,`seg_modulo`.`mod_tipo_user` AS `mod_tipo_user` from `seg_modulo` where (`seg_modulo`.`mod_nivel` = '1') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vt_persona_usuario`
--
DROP TABLE IF EXISTS `vt_persona_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt_persona_usuario`  AS  select `g`.`cc_persona` AS `cc_persona`,`g`.`nombre` AS `nombre`,`g`.`fecha_nacimiento` AS `fecha_nacimiento`,`g`.`num_documento` AS `num_documento`,`g`.`flag_activo` AS `flag_activo`,`s`.`cc_usuario` AS `cc_usuario`,`s`.`cc_user` AS `cc_user`,`s`.`ct_clave` AS `ct_clave`,`s`.`nn_tiempo_sesion` AS `nn_tiempo_sesion`,`s`.`cfl_acceso` AS `cfl_acceso`,`s`.`df_log` AS `df_log`,`s`.`cfl_clave_cambia` AS `cfl_clave_cambia`,`s`.`cc_perfil` AS `cc_perfil`,`s`.`cp_nivel` AS `cp_nivel`,`s`.`df_caduca` AS `df_caduca`,`g`.`flag` AS `flag` from (`gen_personas` `g` join `seg_usuario` `s` on((`g`.`cc_persona` = `s`.`cc_usuario`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fin_caja`
--
ALTER TABLE `fin_caja`
  ADD PRIMARY KEY (`cc_caja`);

--
-- Indices de la tabla `fin_caja_detalle`
--
ALTER TABLE `fin_caja_detalle`
  ADD PRIMARY KEY (`cc_caja_det`),
  ADD KEY `FK_fin_caja_detalle_fin_caja` (`cc_caja`);

--
-- Indices de la tabla `fin_caja_detalle_temp`
--
ALTER TABLE `fin_caja_detalle_temp`
  ADD PRIMARY KEY (`cc_caja_det`);

--
-- Indices de la tabla `fin_compras`
--
ALTER TABLE `fin_compras`
  ADD PRIMARY KEY (`cc_compras`);

--
-- Indices de la tabla `fin_compras_detalle`
--
ALTER TABLE `fin_compras_detalle`
  ADD PRIMARY KEY (`cc_compras_det`),
  ADD KEY `cc_compras` (`cc_compras`);

--
-- Indices de la tabla `fin_compras_detalle_temp`
--
ALTER TABLE `fin_compras_detalle_temp`
  ADD PRIMARY KEY (`cc_compras_det`);

--
-- Indices de la tabla `fin_comprobante`
--
ALTER TABLE `fin_comprobante`
  ADD PRIMARY KEY (`cc_comprobante`);

--
-- Indices de la tabla `fin_documentos_de_venta_items`
--
ALTER TABLE `fin_documentos_de_venta_items`
  ADD PRIMARY KEY (`linea`);

--
-- Indices de la tabla `fin_documentos_de_venta_sustento`
--
ALTER TABLE `fin_documentos_de_venta_sustento`
  ADD PRIMARY KEY (`linea`);

--
-- Indices de la tabla `fin_estado_cuenta`
--
ALTER TABLE `fin_estado_cuenta`
  ADD PRIMARY KEY (`id_c_operacion`);

--
-- Indices de la tabla `fin_estado_cuenta1`
--
ALTER TABLE `fin_estado_cuenta1`
  ADD PRIMARY KEY (`cc_estadocuenta`),
  ADD KEY `FK_fin_estado_cuenta_fin_caja` (`cc_caja`);

--
-- Indices de la tabla `fin_kardex`
--
ALTER TABLE `fin_kardex`
  ADD PRIMARY KEY (`cc_kardex`);

--
-- Indices de la tabla `gen_articulo`
--
ALTER TABLE `gen_articulo`
  ADD PRIMARY KEY (`cc_articulo`);

--
-- Indices de la tabla `gen_articulo1`
--
ALTER TABLE `gen_articulo1`
  ADD PRIMARY KEY (`cc_articulo`);

--
-- Indices de la tabla `gen_documentos_internos`
--
ALTER TABLE `gen_documentos_internos`
  ADD PRIMARY KEY (`linea`);

--
-- Indices de la tabla `gen_empresa`
--
ALTER TABLE `gen_empresa`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_ruc` (`emp_ruc`);

--
-- Indices de la tabla `gen_grupo`
--
ALTER TABLE `gen_grupo`
  ADD PRIMARY KEY (`cc_grupo`);

--
-- Indices de la tabla `gen_personas`
--
ALTER TABLE `gen_personas`
  ADD PRIMARY KEY (`cc_persona`);

--
-- Indices de la tabla `gen_personas1`
--
ALTER TABLE `gen_personas1`
  ADD PRIMARY KEY (`cc_persona`);

--
-- Indices de la tabla `seg_modulo`
--
ALTER TABLE `seg_modulo`
  ADD PRIMARY KEY (`mod_id1`,`mod_id2`,`mod_id3`);

--
-- Indices de la tabla `seg_modulo1`
--
ALTER TABLE `seg_modulo1`
  ADD PRIMARY KEY (`cc_modulo`);

--
-- Indices de la tabla `seg_usuario`
--
ALTER TABLE `seg_usuario`
  ADD PRIMARY KEY (`cc_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fin_caja_detalle`
--
ALTER TABLE `fin_caja_detalle`
  MODIFY `cc_caja_det` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `fin_caja_detalle_temp`
--
ALTER TABLE `fin_caja_detalle_temp`
  MODIFY `cc_caja_det` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fin_compras`
--
ALTER TABLE `fin_compras`
  MODIFY `cc_compras` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2017995517;
--
-- AUTO_INCREMENT de la tabla `fin_compras_detalle`
--
ALTER TABLE `fin_compras_detalle`
  MODIFY `cc_compras_det` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `fin_compras_detalle_temp`
--
ALTER TABLE `fin_compras_detalle_temp`
  MODIFY `cc_compras_det` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `fin_documentos_de_venta_items`
--
ALTER TABLE `fin_documentos_de_venta_items`
  MODIFY `linea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fin_documentos_de_venta_sustento`
--
ALTER TABLE `fin_documentos_de_venta_sustento`
  MODIFY `linea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fin_estado_cuenta`
--
ALTER TABLE `fin_estado_cuenta`
  MODIFY `id_c_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `fin_estado_cuenta1`
--
ALTER TABLE `fin_estado_cuenta1`
  MODIFY `cc_estadocuenta` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2034;
--
-- AUTO_INCREMENT de la tabla `gen_articulo`
--
ALTER TABLE `gen_articulo`
  MODIFY `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT de la tabla `gen_articulo1`
--
ALTER TABLE `gen_articulo1`
  MODIFY `cc_articulo` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT de la tabla `gen_documentos_internos`
--
ALTER TABLE `gen_documentos_internos`
  MODIFY `linea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gen_empresa`
--
ALTER TABLE `gen_empresa`
  MODIFY `emp_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `seg_modulo1`
--
ALTER TABLE `seg_modulo1`
  MODIFY `cc_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
