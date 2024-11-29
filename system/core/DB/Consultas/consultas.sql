UPDATE table_relacion_producto SET cant_producto = 160 WHERE id_producto = 1; 
DELETE FROM table_despacho WHERE id_despacho BETWEEN 149 AND 175;

SELECT * FROM table_relacion_despacho WHERE id_producto = 39;
SELECT * FROM table_producto;
SELECT * FROM table_despacho;
SELECT producto.id_producto AS ID, producto.producto AS PRODUCTO , SUM(tRelacionD.cant_despacho) AS TOTAL_PRODUCTO  
	FROM table_relacion_despacho tRelacionD
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto 
	GROUP BY producto.id_producto;
SELECT producto.id_producto AS ID, producto.producto  AS PRODUCTO, SUM(tRelacionD.cant_despacho) AS TOTAL_PRODUCTO
	FROM table_relacion_despacho tRelacionD
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto 
WHERE producto.id_producto = 36 GROUP BY producto.id_producto;
SELECT producto.id_producto AS ID, producto.producto AS PRODUCTO, tRelacionD.cant_despacho AS CANT_PRODUCTO, desp.fecha_despacho  AS FECHA
	FROM table_relacion_despacho tRelacionD
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto
    INNER JOIN table_despacho desp ON desp.id_despacho = tRelacionD.id_despacho
WHERE producto.id_producto = 1 ORDER BY desp.fecha_despacho DESC;
SELECT producto.id_producto AS ID, producto.producto  AS PRODUCTO, tRelacionD.cant_despacho AS CANT_PRODUCTO, desp.fecha_despacho  AS FECHA
	FROM table_relacion_despacho tRelacionD
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto
    INNER JOIN table_despacho desp ON desp.id_despacho = tRelacionD.id_despacho
	ORDER BY producto.id_producto ASC, desp.fecha_despacho DESC;

SELECT producto.id_producto AS ID, producto.producto  AS PRODUCTO, SUM(tRelacionD.cant_despacho) AS TOTAL_PRODUCTO,
	MIN(desp.fecha_despacho) AS DESDE ,MAX(desp.fecha_despacho) AS HASTA
	FROM table_relacion_despacho tRelacionD
    INNER JOIN table_despacho desp ON desp.id_despacho = tRelacionD.id_despacho
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto 
GROUP BY producto.id_producto;
 
 SELECT producto.id_producto AS ID, flota.id_unidad,producto.producto AS PRODUCTO,
	producto.present_producto AS PRESENTACION ,tRelacionD.cant_despacho AS CANT_PRODUCTO, 
    desp.fecha_despacho  AS FECHA
	FROM table_relacion_despacho tRelacionD
	INNER JOIN table_producto producto ON producto.id_producto = tRelacionD.id_producto
    INNER JOIN table_despacho desp ON desp.id_despacho = tRelacionD.id_despacho
    INNER JOIN table_flota flota ON flota.id_flota = desp.id_flota
WHERE producto.id_producto = 1 ORDER BY desp.fecha_despacho DESC;