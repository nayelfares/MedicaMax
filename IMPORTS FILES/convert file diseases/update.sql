update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.parent_id=parent.id  ;

update  diseases as child right join diseases as parent on child.parent_code=parent.code  set parent.has_child = 0  where child.id is null;







update `diseases` set diseases_level = 1 where parent_code is null ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 2 where parent.diseases_level = 1  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 3 where parent.diseases_level = 2  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 4 where parent.diseases_level = 3  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 5 where parent.diseases_level = 4  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 6 where parent.diseases_level = 5  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 7 where parent.diseases_level = 6  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 8 where parent.diseases_level = 7  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 9 where parent.diseases_level = 8  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 10 where parent.diseases_level = 9  ;

update  diseases as child left join diseases as parent on child.parent_code=parent.code set child.diseases_level = 11 where parent.diseases_level = 10  ;



test:
SELECT * FROM `diseases` WHERE show_code = 1 and code like "%^%"

SELECT id,code,parent_code,show_code FROM `diseases` WHERE show_code = 1 and code like "%^%"

SELECT * FROM `diseases` WHERE show_code = 0 and code not like "%^%"

SELECT id,code,parent_code,show_code FROM `diseases` WHERE show_code = 0 and code not like "%^%"
