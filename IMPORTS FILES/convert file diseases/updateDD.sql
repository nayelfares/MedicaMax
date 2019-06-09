update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.parent_id=parent.id  ;









update `differential_diagnoses` set level = 1 where parent_code is null ;

update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.level = 2 where parent.level = 1  ;

update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.level = 3 where parent.level = 2  ;

update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.level = 4 where parent.level = 3  ;

update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.level = 5 where parent.level = 4  ;

update  differential_diagnoses as child left join differential_diagnoses as parent on child.parent_code=parent.code set child.level = 6 where parent.level = 5  ;
