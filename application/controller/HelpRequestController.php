<?php

/**
 * @author Nick B.
 * @class HelpRequestController
 * @classdesc The HelpRequestController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class HelpRequestController extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function __construct() {
    parent::__construct();
    Auth::checkAuthentication();
  }

  /**
   * @function create
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function create() {
/*
    HelpRequestModel::createHelpRequest(
      Request::post('subj_DD'),
      Request::post('sub_subj_DD'),
      Request::post('req_tutor_DD')
    );
*/
    if (HelpRequestModel::createHelpRequest(Request::post('hidden_tbl_num'), Request::post('subj_DD'), Request::post('sub_subj_DD'), Request::post('req_tutor_DD'))) {
      $this->View->renderEx('student/RequestRedirect');
    }
    Redirect::toDelay('index', '3');
  }

  /**
   * @function update
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function update() {
    //HelpRequestModel::updateEntry(Request::post('name_entry'), Request::post('progress_state'));
    HelpRequestModel::updateEntry(Request::post('name_entry'), Request::post('progress_state'), Request::post('tutor_id'));
    HelpRequestModel::updateNote(Request::post('name_entry'), Request::post('notes_edit'), Request::post('notes_drop'));
  }

  /**
   * @function remove
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function remove() {
	
    HelpRequestModel::updateNote(Request::post('the_id'), Request::post('notes_edit'), Request::post('notes_drop'));
    HelpRequestModel::removeEntry(Request::post('the_id'));
  }

}
