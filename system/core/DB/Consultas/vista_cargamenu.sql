CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `v_carga_menu` AS
    SELECT 
        `a`.`user_nick` AS `login`,
        `a`.`user_nombres` AS `nombres`,
        `a`.`user_apellidos` AS `apellidos`,
        `f`.`rol_id` AS `rol_id`,
        `f`.`rol_name` AS `rol_name`,
        `e`.`id_menu` AS `id_menu`,
        `e`.`nombre_menu` AS `nombre_menu`,
        `e`.`icono_menu` AS `icono_menu`,
        `e`.`page_menu_open` AS `page_menu_open`,
        `e`.`page_link` AS `page_link`,
        `g`.`id_submenu` AS `id_submenu`,
        `g`.`nombre_submenu` AS `nombre_submenu`,
        `g`.`url` AS `url`,
        `g`.`page_link_activo` AS `page_link_activo`
    FROM
        ((((((`table_user` `a`
        JOIN `table_user_rol` `b`)
        JOIN `table_dep_submenu` `c`)
        JOIN `table_menu_submenu` `d`)
        JOIN `table_menu` `e`)
        JOIN `table_roles` `f`)
        JOIN `table_submenu` `g`)
    WHERE
        ((`a`.`user_nick` = `b`.`user_nick`)
            AND (`b`.`id_rol` = `f`.`rol_id`)
            AND (`b`.`id_departamento` = `c`.`id_departamento`)
            AND (`c`.`id_submenu` = `g`.`id_submenu`)
            AND (`g`.`id_submenu` = `d`.`id_submenu`)
            AND (`e`.`id_menu` = `d`.`id_menu`)
            AND (`e`.`status` = 1))