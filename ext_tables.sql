#
# Modifying pages table
#

CREATE TABLE pages (

  semantify_it_annotationID varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewStepOne varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewStepTwo varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewName varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewURL varchar(255) DEFAULT '' NOT NULL

);

#
# Modifying pages_language_overlay table
#
CREATE TABLE pages_language_overlay (
  semantify_it_annotationID varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewStepOne varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewStepTwo varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewName varchar(255) DEFAULT '' NOT NULL
  semantify_it_annotationNewURL varchar(255) DEFAULT '' NOT NULL
);