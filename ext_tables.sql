#
# Modifying pages table
#

CREATE TABLE pages (

  mayrhofen_annotator_annotationID varchar(10) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_ID varchar(10) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_StepOne varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_StepTwo varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_Name varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_URL varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_RAW text NOT NULL
);

#
# Modifying pages_language_overlay table
#
CREATE TABLE pages_language_overlay (
  mayrhofen_annotator_annotationID varchar(10) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_ID varchar(10) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_StepOne varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_StepTwo varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_Name varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_URL varchar(255) DEFAULT '' NOT NULL,
  mayrhofen_annotator_annotationNew_RAW text NOT NULL
);