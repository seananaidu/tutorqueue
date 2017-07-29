<?php

/**
 * @author Nick B.++
 * @class HelpRequestModel
 * @classdesc Help Request functions for adding a student help request to the QSC Queue.
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo 1. DELETE unneeded functions 2. Complete function documentation headers
 */
class HelpRequestModel {

  /**
   * @function getAll
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getAll() {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM tblRequests";
    $query = $database->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  /**
   * @function getAllWait
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getAllWait() {
  }

  /**
   * @function getAllProgress
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getAllProgress() {
  }

  /**
   * @function getAllOld
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function getAllOld() {
  }

  /**
   * @function createHelpRequest
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function createHelpRequest($tbllNo, $subj, $subsubj, $tutorReq) {
    if (!$subj || strlen($subj) == 0) {
      Session::add('feedback_negative', Text::get('FEEDBACK_HELP_REQUEST_CREATION_FAILED'));
      return false;
    }
    $database = DatabaseFactory::getFactory()->getConnection();
    if (strlen($subsubj) > 0 && strlen($tutorReq) > 0) {
      $sql = "INSERT INTO qscQueue.tblRequests (tableNo, subject, subSubject, tutorRequested, serviceState) VALUES (:table_num, :subj_DD, :sub_subj_DD, :req_tutor_DD, 'wait')";
      $query = $database->prepare($sql);
      $query->execute(array(':table_num' => $tbllNo, ':subj_DD' => $subj, ':sub_subj_DD' => $subsubj, ':req_tutor_DD' => $tutorReq));
      if ($query->rowCount() == 1) {
        return true;
      }
    } elseif (strlen($subsubj) > 0 && strlen($tutorReq) == 0) {
      $sql = "INSERT INTO qscQueue.tblRequests (tableNo, subject, subSubject, serviceState) VALUES (:table_num, :subj_DD, :sub_subj_DD, 'wait')";
      $query = $database->prepare($sql);
      $query->execute(array(':table_num' => $tbllNo, ':subj_DD' => $subj, ':sub_subj_DD' => $subsubj));
      if ($query->rowCount() == 1) {
        return true;
      }
    } elseif (strlen($subsubj) == 0 && strlen($tutorReq) > 0) {
      $sql = "INSERT INTO qscQueue.tblRequests (tableNo, subject, tutorRequested, serviceState) VALUES (:table_num, :subj_DD, :req_tutor_DD, 'wait')";
      $query = $database->prepare($sql);
      $query->execute(array(':table_num' => $tbllNo, ':subj_DD' => $subj, ':req_tutor_DD' => $tutorReq));
      if ($query->rowCount() == 1) {
        return true;
      }
    } else {
      $sql = "INSERT INTO qscQueue.tblRequests (tableNo, subject, serviceState) VALUES (:table_num, :subj_DD, 'wait')";
      $query = $database->prepare($sql);
      $query->execute(array(':table_num' => $tbllNo, ':subj_DD' => $subj));
      if ($query->rowCount() == 1) {
        return true;
      }
    }

    Session::add('feedback_negative', Text::get('FEEDBACK_HELP_REQUEST_EDITING_FAILED'));
    return false;
  }

  /**
   * @function updateEntry
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function updateEntry($name_num, $state_of, $tutor_num) {

  	if ($state_of == 'progress') 
  	{
  		$database = DatabaseFactory::getFactory()->getConnection();
    	//$sql = "UPDATE qscQueue.tblRequests SET serviceState = :state_of_text, tsSessionStart = Now() WHERE id = :name_num_id";
      $sql = "UPDATE qscQueue.tblRequests SET serviceState = :state_of_text, tsSessionStart = Now(), helpingTutor = (SELECT name FROM qscTutorList.tblAllTutors WHERE tutcode = :tut_code_id) WHERE id = :name_num_id";
    	$query = $database->prepare($sql);
    	$res = $query->execute(array(':state_of_text' => $state_of, ':name_num_id' => $name_num, ':tut_code_id' => $tutor_num));
  	}

  	else if ($state_of == 'done') 
  	{
  		$database = DatabaseFactory::getFactory()->getConnection();
    	$sql = "UPDATE qscQueue.tblRequests SET serviceState = :state_of_text, tsSessionEnd = Now() WHERE id = :name_num_id";
    	$query = $database->prepare($sql);
    	$res = $query->execute(array(':state_of_text' => $state_of, ':name_num_id' => $name_num));
  	}

    else if ($state_of == 'wait')
    {
      $database = DatabaseFactory::getFactory()->getConnection();
      $sql = "UPDATE qscQueue.tblRequests SET serviceState = :state_of_text, tsSessionStart = Now(), attemptedHelp = (SELECT name FROM qscTutorList.tblAllTutors WHERE tutcode = :tut_code_id), helpingTutor = '' WHERE id = :name_num_id";
      $query = $database->prepare($sql);
      $res = $query->execute(array(':state_of_text' => $state_of, ':name_num_id' => $name_num, ':tut_code_id' => $tutor_num));
    }
  
    
  	else 
  	{ 
    	$database = DatabaseFactory::getFactory()->getConnection();
    	$sql = "UPDATE qscQueue.tblRequests SET serviceState = :state_of_text WHERE id = :name_num_id";
      
    	$query = $database->prepare($sql);
    	$res = $query->execute(array(':state_of_text' => $state_of, ':name_num_id' => $name_num));
    }
    
  }

    
  

  /**
   * @function removeEntry
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function removeEntry($the_id) {
    $database = DatabaseFactory::getFactory()->getConnection();
// bad!, don't actually delete, just remove from the active states
//    $sql = "DELETE FROM qscQueue.tblRequests WHERE tblRequests.id = :removable_id";
//    $sql = "UPDATE `qscQueue.tblRequests` SET serviceState = archived WHERE tblRequests.id = :removable_id";
//    $sql = "UPDATE  `qscQueue`.`tblRequests` SET  `serviceState` =  'archived' WHERE  `tblRequests`.`id` = :removable_id";

    $sql = "UPDATE qscQueue.tblRequests SET serviceState = 'archived', counterWaiting = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tsRequest, tsSessionStart)), counterSession = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tsSessionStart, tsSessionEnd)) WHERE tblRequests.id = :removable_id";


    $query = $database->prepare($sql);
    $res = $query->execute(array(':removable_id' => $the_id));
  }

  /**
   * @function updateNote
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function updateNote($note_id, $note_text, $note_drop) {
   if (!$note_id || (!$note_text && !$note_drop)) {
      return false;
    }

    if ($note_text && !$note_drop) {
      $database = DatabaseFactory::getFactory()->getConnection();
      $sql = "UPDATE qscQueue.tblRequests SET notesEditable = concat(notesEditable, :note_text) WHERE id = :note_id";
      $query = $database->prepare($sql);
      $query->execute(array(':note_id' => $note_id, ':note_text' => ($note_text .= "; ")));
    }

    if ($note_drop && !$note_text) {
      $database = DatabaseFactory::getFactory()->getConnection();
      $sql = "UPDATE qscQueue.tblRequests SET notesDropDown = concat(notesDropDown, :drop_note) WHERE id = :note_id";
      $query = $database->prepare($sql);
      $query->execute(array(':note_id' => $note_id, ':drop_note' => ($note_drop .= "; ")));
    }

    if ($note_drop && $note_text) {
      $database = DatabaseFactory::getFactory()->getConnection();
      //$sql = "UPDATE qscQueue.tblRequests SET notesEditable = concat(notesEditable, :note_text) WHERE id = :note_id";
      $sql = "UPDATE qscQueue.tblRequests SET notesEditable = concat(notesEditable, :note_text), notesDropDown = concat(notesDropDown, :drop_note) WHERE id = :note_id";
      $query = $database->prepare($sql);
      $query->execute(array(':note_id' => $note_id, ':note_text' => ($note_text .= "; "), ':drop_note' => ($note_drop .= "; ")));
    }
    
    if ($query->rowCount() == 1) {
      return true;
    }
    Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_EDITING_FAILED'));
    
    return false;
  }

  /**
   * @function deleteNote
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public static function deleteNote($note_id) {
    if (!$note_id) {
      return false;
    }
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "DELETE FROM notes WHERE note_id = :note_id AND user_id = :user_id LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':note_id' => $note_id, ':user_id' => Session::get('user_id')));
    if ($query->rowCount() == 1) {
      return true;
    }
    Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_DELETION_FAILED'));
    return false;
  }
}
