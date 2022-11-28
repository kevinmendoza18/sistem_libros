SELECT personas.id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS nombre_completo, sexo.nombre  AS sexo, ciudades.nombre AS ciudades, fecha_nacimiento 
FROM personas JOIN ciudades ON ciudades.id = personas.id_ciudad
JOIN sexo ON sexo.id = personas.id_sexo
