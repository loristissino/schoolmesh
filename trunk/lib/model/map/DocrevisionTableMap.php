<?php


/**
 * This class defines the structure of the 'docrevision' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class DocrevisionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.DocrevisionTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('docrevision');
		$this->setPhpName('Docrevision');
		$this->setClassname('Docrevision');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('DOCUMENT_ID', 'DocumentId', 'INTEGER', 'document', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
		$this->addColumn('REVISION_NUMBER', 'RevisionNumber', 'INTEGER', true, null, null);
		$this->addColumn('REVISIONED_AT', 'RevisionedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('UPLOADER_ID', 'UploaderId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('REVISIONER_ID', 'RevisionerId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('APPROVED_AT', 'ApprovedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('APPROVER_ID', 'ApproverId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('REVISION_GROUNDS', 'RevisionGrounds', 'LONGVARCHAR', true, null, null);
		$this->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CONTENT_TYPE', 'ContentType', 'INTEGER', false, null, null);
		$this->addForeignKey('SOURCE_ATTACHMENT_ID', 'SourceAttachmentId', 'INTEGER', 'attachment_file', 'ID', false, null, null);
		$this->addForeignKey('PUBLISHED_ATTACHMENT_ID', 'PublishedAttachmentId', 'INTEGER', 'attachment_file', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Document', 'Document', RelationMap::MANY_TO_ONE, array('document_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('sfGuardUserRelatedByUploaderId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('uploader_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('sfGuardUserRelatedByRevisionerId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('revisioner_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('sfGuardUserRelatedByApproverId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('approver_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('AttachmentFileRelatedBySourceAttachmentId', 'AttachmentFile', RelationMap::MANY_TO_ONE, array('source_attachment_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('AttachmentFileRelatedByPublishedAttachmentId', 'AttachmentFile', RelationMap::MANY_TO_ONE, array('published_attachment_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Document', 'Document', RelationMap::ONE_TO_MANY, array('id' => 'docrevision_id', ), null, null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
		);
	} // getBehaviors()

} // DocrevisionTableMap
