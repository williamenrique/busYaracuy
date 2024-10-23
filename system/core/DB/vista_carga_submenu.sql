CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `v_submenu` AS
    SELECT 
        `e`.`id_menu` AS `id_menu`,
        `g`.`id_submenu` AS `id_submenu`,
        `g`.`nombre_submenu` AS `nombre_submenu`,
        `g`.`url` AS `url`,
        `g`.`page_link_activo` AS `page_link_activo`
    FROM
        ((`table_menu_submenu` `d`
        JOIN `table_menu` `e`)
        JOIN `table_submenu` `g`)
    WHERE
        ((`g`.`id_submenu` = `d`.`id_submenu`)
            AND (`e`.`id_menu` = `d`.`id_menu`))