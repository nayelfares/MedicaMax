<?php

/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('e', function () {
    return view('/layouts/admin');
});

Route::get('/', function () {
    return view('welcome');
});






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


///////////////////////////////DRUG   MANAGEMENT/////////////////////////////////////////////////////
Route::get('/dashboard', function () {
    return view('dashboard');
});
//Unit
Route::resource('drug-administration/unit','UnitController');
Route::post('drug-administration/unit/search', 'UnitController@search')->name('unit.search');

//Giving
Route::resource('drug-administration/giving','GivingController');
//Route::post('drug-administration/giving/search', 'GivingController@search')->name('giving.search');

//DailyDose
//Route::resource('drug-administration/dailyDose','DailyDoseController');
//Route::post('drug-administration/dailyDose/search', 'DailyDoseController@search')->name('dailyDose.search');

//Company
Route::resource('drug-administration/company','CompanyController');
//Route::post('drug-administration/company/search', 'CompanyController@search')->name('company.search');
Route::get('companiesExport', 'CompanyController@companiesExport')->name('company.export');
Route::get('CompanyimportEnterExcelFile', 'CompanyController@importInterface')->name('company.import_interface');
Route::post('companyimport','CompanyController@companiesImport')->name('company.import');

//classification
Route::resource('drug-administration/classification','ClassificationController');
//Route::post('drug-administration/classification/search', 'ClassificationController@search')->name('classification.search');

Route::get('classificationsExport', 'ClassificationController@classificationsExport')->name('classification.export');
Route::get('classificationimportEnterExcelFile', 'ClassificationController@importInterface')->name('classification.import_interface');
Route::post('classificationimport','ClassificationController@classificationsImport')->name('classification.import');

//Tree
//Tree
Route::get( 'draw','ClassificationController@treeView')->name('classification.draw');
Route::get( 'draw_tree','ClassificationController@draw_tree')->name('classification.draw_tree');
Route::get( 'build_tree','ClassificationController@build_tree')->name('classification.build_tree');
Route::get( 'draw_tree3','ClassificationController@draw_tree3')->name('classification.draw_tree3');
Route::get( 'build_tree_ar','ClassificationController@build_tree_ar')->name('classification.build_tree_ar');
Route::get( 'draw_tree3_ar','ClassificationController@draw_tree3_ar')->name('classification.draw_tree3_ar');
Route::get( 'search_','ClassificationController@search_')->name('classification.search_');
Route::get( 're_indexing','ClassificationController@re_indexing')->name('classification.re_indexing');

//node
Route::get('delete_node', 'ClassificationController@delete_node')->name('node.delete');
Route::get('view_', 'ClassificationController@view_node')->name('node.view');
Route::get('save', 'ClassificationController@save_node')->name('node.save');
Route::get('update_parent', 'ClassificationController@update_parent')->name('update_parent');
Route::get('term_replace', 'ClassificationController@term_replace')->name('classification.term_replace');





//form
Route::resource('drug-administration/form','FormController');
//Route::post('drug-administration/form/search', 'FormController@search')->name('form.search');
Route::get('formsExport', 'FormController@formsExport')->name('form.export');
Route::get('formimportEnterExcelFile', 'FormController@importInterface')->name('form.import_interface');
Route::post('formimport','FormController@formsImport')->name('form.import');

//Drug
Route::resource('drug-administration/drug','DrugController');
//Route::post('drug-administration/drug/search', 'DrugController@search')->name('drug.search');
Route::get('drugsExport', 'DrugController@drugsExport')->name('drug.export');
Route::get('drugimportEnterExcelFile', 'DrugController@importInterface')->name('drug.import_interface');
Route::post('drugimport','DrugController@drugsImport')->name('drug.import');

Route::get('chemical_CompositionsExport', 'DrugController@chemical_compositionsExport')->name('chemical_Composition.export');
Route::get('chemical_CompositionsimportEnterExcelFile', 'DrugController@importInterface_ch_co')->name('chemical_Composition.import_interface');
Route::post('chemical_Compositionimport','DrugController@chemical_compositionsImport')->name('chemical_Composition.import');


Route::get('clone','DrugController@clone')->name('drug.clone');
Route::post('store_clone','DrugController@storeClone')->name('drug.store_clone');
Route::get('get_details_leaflets','DrugController@getDetailsLeaflet')->name('drug.getDetailsLeaflet');

//CRUD DRUGS
Route::get('get_Classifications','DrugController@getClassifications')->name("drug.getClassification");
Route::get('get_Forms','DrugController@getForms')->name("drug.getForm");
Route::get('get_Companies','DrugController@getCompanies')->name("drug.getCompanies");
Route::get('get_leaflets','DrugController@getLeaflets')->name('drug.getLeaflets');
Route::get('get_LeafletsByDrug','DrugController@getLeafletsByDrug')->name('drug.getLeafletsByDrug');
Route::get('get_statuses','DrugController@getStatuses')->name('drug.getStatuses');
Route::get('get_form_unit','DrugController@getFormUnit')->name('drug.getFormUnit');
Route::get('get_Compositions','DrugController@getCompositions')->name('drug.getCompositions');
Route::get('submit_drug','DrugController@submit_drug')->name('drug.submit_drug');
Route::get('delete_drug','DrugController@delete_drug')->name('drug.delete_drug');
Route::get('get_drug_detailes','DrugController@get_drug_detailes')->name('drug.get_drug_detailes');
Route::get('get_Images','DrugController@getImages')->name('drug.getImages');
//Picture
Route::get('destroy', 'PictureController@deleteImage')->name('picture.delete');
Route::post('upload', 'PictureController@create')->name('picture.upload');


//leaflet
Route::resource('drug-administration/leaflet','LeafletController');
//Route::post('drug-administration/leaflet/search', 'LeafletController@search')->name('leaflet.search');

//compositions
Route::resource('drug-administration/composition','CompositionController');
//Route::post('drug-administration/composition/search', 'CompositionController@search')->name('composition.search');
Route::get('compositionsExport', 'CompositionController@compositionsExport')->name('composition.export');
Route::get('compositionimportEnterExcelFile', 'CompositionController@importInterface')->name('composition.import_interface');
Route::post('compositionimport','CompositionController@formsImport')->name('composition.import');
Route::get('get_quantities','CompositionController@getQuantities')->name('composition.getQuantities');

//Composition Quantity
Route::get('quantitycompositionimportEnterExcelFile', 'CompositionQuantityController@importInterface')->name('CompositionQuantity.import_interface');
Route::post('quantitycompositionimport','CompositionQuantityController@QuantityCompositionImport')->name('quantitycomposition.import');


/*********************
* 
*   Diseases 
*
**********************/
/*
* The Disease Controller Route
*/
Route::resource('drug-administration/disease','DiseaseController');

/*
* Build English Tree
*/
Route::get( 'draw_en_tree','DiseaseController@draw_en_tree')->name('disease.draw_en_tree');
Route::get('tree_ar/{id}','DiseaseController@build_diseases_tree_en')->name('disease.en_tree');
/*
* Delete Node
*/
Route::get('delete_disease_node', 'DiseaseController@delete_disease_node')->name('disease_node.delete');
/*
* Update Parent Node
*/
Route::get('update_parent_disease', 'DiseaseController@update_parent_disease')->name('update_parent_disease');
/*
* View Node
*/
Route::get('disease_node_view', 'DiseaseController@disease_view_node')->name('disease_node.view');
/*
* Search for Nodes
*/
Route::get( 'disease_search','DiseaseController@disease_search')->name('disease_node.search');
/*
* Save Node and Create
*/
Route::post('disease_node_save_', 'DiseaseController@disease_node_save')->name('disease_node.save');
/*
* Replace String in Term
*/
Route::get('disease_term_replace', 'DiseaseController@disease_term_replace')->name('disease_term.replace');
/*
* Get Parents Code
*/
Route::get('diseases_get_parents','DiseaseController@get_parent_codes')->name('dis_get_parent_codes');
/*
* Get Parents Code
*/
Route::get('get_all_parents_for_node','DiseaseController@get_all_parents_for_node')->name('get_all_parents_for_node');
/*
* create simple arabic term for search 
*/
Route::post('diseases.s_ar_term','DiseaseController@create_simple_ar_term_to_nodes')->name('diseases.s_ar_term');
/*
* Disease Export &&  Import
*/
Route::get('DiseasesExport', 'DiseaseController@DiseasesExport')->name('disease.export');
Route::get('import_interface_', 'DiseaseController@importInterface')->name('disease.import_interface');
Route::post('diseaseimport','DiseaseController@diseasesImport')->name('disease.import');

/*********************
* 
*   Differential Diagnosis 
*
**********************/
/*
* The Differential Diagnosis Controller Route
*/
Route::resource('drug-administration/differentialDiagnosis','DifferentialDiagnosisController');

/*
* Build English Tree
*/
Route::get( 'dd_draw_en_tree','DifferentialDiagnosisController@draw_en_tree')->name('dif_dia.draw_en_tree');
Route::get('dd_en_tree','DifferentialDiagnosisController@build_en_tree')->name('dif_dia.en_tree');
/*
* Delete Node
*/
Route::get('delete_dif_dia_node', 'DifferentialDiagnosisController@delete_node')->name('dif_dia_node.delete');
/*
* Update Parent Node
*/
Route::get('update_parent_dif_dia', 'DifferentialDiagnosisController@update_parent')->name('update_parent_dif_dia');
/*
* View Node
*/
Route::get('dif_dia_node_view', 'DifferentialDiagnosisController@view_node')->name('dif_dia_node.view');
/*
* Search for Nodes
*/
Route::get( 'dif_dia_search','DifferentialDiagnosisController@search')->name('dif_dia_node.search');
/*
* Save Node and Create
*/
Route::post('dif_dia_node_save', 'DifferentialDiagnosisController@save_node')->name('dif_dia_node.save');
/*
* Replace String in Term
*/
Route::get('dif_dia_term_replace', 'DifferentialDiagnosisController@term_replace')->name('dif_dia_term.replace');
/*
* Get Parents Code
*/
Route::get('dif_dias_get_parents','DifferentialDiagnosisController@get_parent_codes')->name('get_parent_codes');
/*
* dif_dia Export &&  Import 
*/
Route::get('dif_diasExport', 'DifferentialDiagnosisController@dif_diasExport')->name('dif_dia.export');
Route::get('dd_import_interface', 'DifferentialDiagnosisController@importInterface')->name('dif_dia.import_interface');
Route::post('dif_diaimport','DifferentialDiagnosisController@dif_diasImport')->name('dif_dia.import');


/*********************
* 
*   Tags 
*
**********************/
Route::resource('drug-administration/tag','TagController');
Route::get('get_tags','TagController@get_tags')->name('tag.get_tags');
Route::get('get_details_tag','TagController@get_details')->name('tag.get_details');
Route::get('save_tag','TagController@save_tag')->name('tag.save_tag');

Route::get('replace_code_with_tag','TagController@replace_code_with_tag')->name('tag.replace_code_with_tag');


/*********************
* 
*   Style 
*
**********************/
Route::resource('drug-administration/style','StyleController');
Route::get('get_styles','StyleController@get_styles')->name('style.get_styles');
Route::get('get_details_style','StyleController@get_details')->name('style.get_details');
Route::post('save_style','StyleController@save_style')->name('style.save_style');

/*********************
* 
*   MultiMedia 
*
**********************/
Route::resource('drug-administration/multi_media','MultiMediaController');
Route::get('get_multi_media','MultiMediaController@get_multi_media')->name('multi_media.get_multi_media');
Route::get('get_details_multi_media','MultiMediaController@get_details')->name('multi_media.get_details');
Route::post('save_multi_media','MultiMediaController@save_multi_media')->name('multi_media.save_multi_media');
/*********************
* 
*   Dictionary 
*
**********************/
Route::resource('drug-administration/dictionary','DictionaryController');
Route::get('get_details_dictionary','DictionaryController@get_details')->name('dictionary.get_details');
Route::post('save_dictionary','DictionaryController@save_dictionary')->name('dictionary.save_dictionary');
Route::get('dictionary_export', 'DictionaryController@export_dictionary')->name('dictionary.export');
Route::get('dictionary_import_interface', 'DictionaryController@importInterface')->name('dictionary.import_interface');
Route::post('dictionary_import','DictionaryController@import_dictionary')->name('dictionary.import');
Route::get('dictionary_search', 'DictionaryController@search')->name('dictionary.search');

///////////////////////////////USER   MANAGEMENT///////////////////////////////////////////////////////////////
Route::resource('user_management/country','CountryController');

