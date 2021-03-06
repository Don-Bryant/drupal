<?php
// @codingStandardsIgnoreFile
/**
 * @file
 * Contains database additions to drupal-8.filled.standard.php.gz for testing
 * the upgrade paths of the Workspaces module.
 */

use Drupal\Core\Database\Database;

$connection = Database::getConnection();

// Set the schema version.
$connection->merge('key_value')
  ->fields([
    'value' => 'i:8000;',
    'name' => 'workspaces',
    'collection' => 'system.schema',
  ])
  ->condition('collection', 'system.schema')
  ->condition('name', 'workspaces')
  ->execute();

// Update core.extension.
$extensions = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute()
  ->fetchField();
$extensions = unserialize($extensions);
$extensions['module']['workspaces'] = 8000;
$connection->update('config')
  ->fields([
    'data' => serialize($extensions),
    'collection' => '',
    'name' => 'core.extension',
  ])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

// Insert Workspaces' config objects.
$connection->insert('config')
->fields(array(
  'collection',
  'name',
  'data',
))
->values(array(
  'collection' => '',
  'name' => 'core.entity_form_display.workspace.workspace.deploy',
  'data' => 'a:11:{s:4:"uuid";s:36:"0208740d-b830-46d6-bc4b-9f880729a26a";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:2:{s:6:"config";a:1:{i:0;s:38:"core.entity_form_mode.workspace.deploy";}s:6:"module";a:1:{i:0;s:10:"workspaces";}}s:5:"_core";a:1:{s:19:"default_config_hash";s:43:"y_XXBDxxmhgsWMxWsyUrGX2giUDI6aS-cxP_5BK0WZM";}s:2:"id";s:26:"workspace.workspace.deploy";s:16:"targetEntityType";s:9:"workspace";s:6:"bundle";s:9:"workspace";s:4:"mode";s:6:"deploy";s:7:"content";a:0:{}s:6:"hidden";a:1:{s:3:"uid";b:1;}}',
))
  ->values(array(
  'collection' => '',
  'name' => 'core.entity_form_mode.workspace.deploy',
  'data' => 'a:9:{s:4:"uuid";s:36:"fd8d0149-716f-44b2-a817-fbe8b2107938";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:1:{s:6:"module";a:1:{i:0;s:10:"workspaces";}}s:5:"_core";a:1:{s:19:"default_config_hash";s:43:"e0Wvw-yOQy3q1edTu3t5bLP5tZFdJeq9PDFhs_XEAlg";}s:2:"id";s:16:"workspace.deploy";s:5:"label";s:6:"Deploy";s:16:"targetEntityType";s:9:"workspace";s:5:"cache";b:1;}',
))
->execute();

// Insert Workspaces' key_value entries.
$connection->insert('key_value')
->fields(array(
  'collection',
  'name',
  'value',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'workspace.entity_type',
  'value' => 'O:36:"Drupal\Core\Entity\ContentEntityType":42:{s:25:" * revision_metadata_keys";a:1:{s:16:"revision_default";s:16:"revision_default";}s:31:" * requiredRevisionMetadataKeys";a:1:{s:16:"revision_default";s:16:"revision_default";}s:15:" * static_cache";b:1;s:15:" * render_cache";b:1;s:19:" * persistent_cache";b:1;s:14:" * entity_keys";a:10:{s:2:"id";s:2:"id";s:8:"revision";s:11:"revision_id";s:4:"uuid";s:4:"uuid";s:5:"label";s:5:"label";s:3:"uid";s:3:"uid";s:5:"owner";s:3:"uid";s:6:"bundle";s:0:"";s:8:"langcode";s:0:"";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";}s:5:" * id";s:9:"workspace";s:16:" * originalClass";s:34:"Drupal\workspaces\Entity\Workspace";s:11:" * handlers";a:6:{s:12:"list_builder";s:39:"\Drupal\workspaces\WorkspaceListBuilder";s:6:"access";s:47:"Drupal\workspaces\WorkspaceAccessControlHandler";s:14:"route_provider";a:1:{s:4:"html";s:50:"\Drupal\Core\Entity\Routing\AdminHtmlRouteProvider";}s:4:"form";a:6:{s:7:"default";s:37:"\Drupal\workspaces\Form\WorkspaceForm";s:3:"add";s:37:"\Drupal\workspaces\Form\WorkspaceForm";s:4:"edit";s:37:"\Drupal\workspaces\Form\WorkspaceForm";s:6:"delete";s:43:"\Drupal\workspaces\Form\WorkspaceDeleteForm";s:8:"activate";s:45:"\Drupal\workspaces\Form\WorkspaceActivateForm";s:6:"deploy";s:43:"\Drupal\workspaces\Form\WorkspaceDeployForm";}s:7:"storage";s:46:"Drupal\Core\Entity\Sql\SqlContentEntityStorage";s:12:"view_builder";s:36:"Drupal\Core\Entity\EntityViewBuilder";}s:19:" * admin_permission";s:21:"administer workspaces";s:25:" * permission_granularity";s:11:"entity_type";s:8:" * links";a:6:{s:8:"add-form";s:37:"/admin/config/workflow/workspaces/add";s:9:"edit-form";s:57:"/admin/config/workflow/workspaces/manage/{workspace}/edit";s:11:"delete-form";s:59:"/admin/config/workflow/workspaces/manage/{workspace}/delete";s:13:"activate-form";s:61:"/admin/config/workflow/workspaces/manage/{workspace}/activate";s:11:"deploy-form";s:59:"/admin/config/workflow/workspaces/manage/{workspace}/deploy";s:10:"collection";s:33:"/admin/config/workflow/workspaces";}s:17:" * label_callback";N;s:21:" * bundle_entity_type";N;s:12:" * bundle_of";N;s:15:" * bundle_label";N;s:13:" * base_table";s:9:"workspace";s:22:" * revision_data_table";s:24:"workspace_field_revision";s:17:" * revision_table";s:18:"workspace_revision";s:13:" * data_table";s:20:"workspace_field_data";s:11:" * internal";b:0;s:15:" * translatable";b:0;s:19:" * show_revision_ui";b:0;s:8:" * label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:9:"Workspace";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:19:" * label_collection";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:10:"Workspaces";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:17:" * label_singular";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:9:"workspace";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:15:" * label_plural";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:10:"workspaces";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:14:" * label_count";a:3:{s:8:"singular";s:16:"@count workspace";s:6:"plural";s:17:"@count workspaces";s:7:"context";N;}s:15:" * uri_callback";N;s:8:" * group";s:7:"content";s:14:" * group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:7:"Content";s:12:" * arguments";a:0:{}s:10:" * options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:" * field_ui_base_route";s:27:"entity.workspace.collection";s:26:" * common_reference_target";b:0;s:22:" * list_cache_contexts";a:0:{}s:18:" * list_cache_tags";a:1:{i:0;s:14:"workspace_list";}s:14:" * constraints";a:2:{s:13:"EntityChanged";N;s:26:"EntityUntranslatableFields";N;}s:13:" * additional";a:0:{}s:8:" * class";s:34:"Drupal\workspaces\Entity\Workspace";s:11:" * provider";s:10:"workspaces";s:14:" * _serviceIds";a:0:{}s:18:" * _entityStorages";a:0:{}s:20:" * stringTranslation";N;}',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'workspace.field_storage_definitions',
  'value' => 'a:8:{s:2:"id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:6:"string";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:2;s:13:" * definition";a:3:{s:4:"type";s:17:"field_item:string";s:8:"settings";a:3:{s:10:"max_length";i:128;s:8:"is_ascii";b:0;s:14:"case_sensitive";b:0;}s:11:"constraints";a:1:{s:11:"ComplexData";a:1:{s:5:"value";a:1:{s:5:"Regex";a:1:{s:7:"pattern";s:14:"/^[a-z0-9_]+$/";}}}}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:12:"Workspace ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:17:"The workspace ID.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"required";b:1;s:11:"constraints";a:2:{s:11:"UniqueField";N;s:16:"DeletedWorkspace";N;}s:8:"provider";s:10:"workspaces";s:10:"field_name";s:2:"id";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:4:"uuid";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:4:"uuid";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:6:"binary";b:0;}}s:11:"unique keys";a:1:{s:5:"value";a:1:{i:0;s:5:"value";}}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:45;s:13:" * definition";a:2:{s:4:"type";s:15:"field_item:uuid";s:8:"settings";a:3:{s:10:"max_length";i:128;s:8:"is_ascii";b:1;s:14:"case_sensitive";b:0;}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:4:"UUID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"read-only";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:4:"uuid";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:11:"revision_id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"integer";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:78;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:integer";s:8:"settings";a:6:{s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:3:"min";s:0:"";s:3:"max";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:11:"Revision ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"read-only";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:11:"revision_id";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:3:"uid";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:16:"entity_reference";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:9:"target_id";a:3:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:3:"int";s:8:"unsigned";b:1;}}s:7:"indexes";a:1:{s:9:"target_id";a:1:{i:0;s:9:"target_id";}}s:11:"unique keys";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:112;s:13:" * definition";a:2:{s:4:"type";s:27:"field_item:entity_reference";s:8:"settings";a:3:{s:11:"target_type";s:4:"user";s:7:"handler";s:7:"default";s:16:"handler_settings";a:0:{}}}}s:13:" * definition";a:10:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:5:"Owner";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:12:"translatable";b:0;s:22:"default_value_callback";s:57:"Drupal\workspaces\Entity\Workspace::getDefaultEntityOwner";s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:20:"The workspace owner.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:7:"display";a:1:{s:4:"form";a:2:{s:7:"options";a:2:{s:4:"type";s:29:"entity_reference_autocomplete";s:6:"weight";i:5;}s:12:"configurable";b:1;}}s:8:"provider";s:10:"workspaces";s:10:"field_name";s:3:"uid";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:5:"label";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:6:"string";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:156;s:13:" * definition";a:2:{s:4:"type";s:17:"field_item:string";s:8:"settings";a:3:{s:10:"max_length";i:128;s:8:"is_ascii";b:0;s:14:"case_sensitive";b:0;}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:14:"Workspace name";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:19:"The workspace name.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:12:"revisionable";b:1;s:8:"required";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:5:"label";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:7:"changed";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"changed";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:1:{s:4:"type";s:3:"int";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:192;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:changed";s:8:"settings";a:0:{}}}s:13:" * definition";a:8:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:7:"Changed";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:44:"The time that the workspace was last edited.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:7:"changed";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:7:"created";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"created";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:1:{s:4:"type";s:3:"int";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:222;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:created";s:8:"settings";a:0:{}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:7:"Created";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:40:"The time that the workspace was created.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"provider";s:10:"workspaces";s:10:"field_name";s:7:"created";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}s:16:"revision_default";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"boolean";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:2:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:251;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:boolean";s:8:"settings";a:2:{s:8:"on_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:2:"On";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"off_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:3:"Off";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}}}}s:13:" * definition";a:11:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:16:"Default revision";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:72:"A flag indicating whether this was a default revision when it was saved.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:16:"storage_required";b:1;s:8:"internal";b:1;s:12:"translatable";b:0;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:16:"revision_default";s:11:"entity_type";s:9:"workspace";s:6:"bundle";N;s:13:"initial_value";N;}}}',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'workspace_association.entity_type',
  'value' => 'O:36:"Drupal\Core\Entity\ContentEntityType":42:{s:25:" * revision_metadata_keys";a:1:{s:16:"revision_default";s:16:"revision_default";}s:31:" * requiredRevisionMetadataKeys";a:1:{s:16:"revision_default";s:16:"revision_default";}s:15:" * static_cache";b:1;s:15:" * render_cache";b:1;s:19:" * persistent_cache";b:1;s:14:" * entity_keys";a:7:{s:2:"id";s:2:"id";s:8:"revision";s:11:"revision_id";s:4:"uuid";s:4:"uuid";s:6:"bundle";s:0:"";s:8:"langcode";s:0:"";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";}s:5:" * id";s:21:"workspace_association";s:16:" * originalClass";s:45:"Drupal\workspaces\Entity\WorkspaceAssociation";s:11:" * handlers";a:3:{s:7:"storage";s:45:"Drupal\workspaces\WorkspaceAssociationStorage";s:6:"access";s:45:"Drupal\Core\Entity\EntityAccessControlHandler";s:12:"view_builder";s:36:"Drupal\Core\Entity\EntityViewBuilder";}s:19:" * admin_permission";N;s:25:" * permission_granularity";s:11:"entity_type";s:8:" * links";a:0:{}s:17:" * label_callback";N;s:21:" * bundle_entity_type";N;s:12:" * bundle_of";N;s:15:" * bundle_label";N;s:13:" * base_table";s:21:"workspace_association";s:22:" * revision_data_table";N;s:17:" * revision_table";s:30:"workspace_association_revision";s:13:" * data_table";N;s:11:" * internal";b:1;s:15:" * translatable";b:0;s:19:" * show_revision_ui";b:0;s:8:" * label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:21:"Workspace association";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:19:" * label_collection";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:22:"Workspace associations";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:17:" * label_singular";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:21:"workspace association";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:15:" * label_plural";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:22:"workspace associations";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:14:" * label_count";a:3:{s:8:"singular";s:28:"@count workspace association";s:6:"plural";s:29:"@count workspace associations";s:7:"context";N;}s:15:" * uri_callback";N;s:8:" * group";s:7:"content";s:14:" * group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:7:"Content";s:12:" * arguments";a:0:{}s:10:" * options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:" * field_ui_base_route";N;s:26:" * common_reference_target";b:0;s:22:" * list_cache_contexts";a:0:{}s:18:" * list_cache_tags";a:1:{i:0;s:26:"workspace_association_list";}s:14:" * constraints";a:1:{s:26:"EntityUntranslatableFields";N;}s:13:" * additional";a:0:{}s:8:" * class";s:45:"Drupal\workspaces\Entity\WorkspaceAssociation";s:11:" * provider";s:10:"workspaces";s:14:" * _serviceIds";a:0:{}s:18:" * _entityStorages";a:0:{}s:20:" * stringTranslation";N;}',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'workspace_association.field_storage_definitions',
  'value' => 'a:8:{s:2:"id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"integer";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:2;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:integer";s:8:"settings";a:6:{s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:3:"min";s:0:"";s:3:"max";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:2:"ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"read-only";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:2:"id";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:4:"uuid";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:4:"uuid";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:6:"binary";b:0;}}s:11:"unique keys";a:1:{s:5:"value";a:1:{i:0;s:5:"value";}}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:36;s:13:" * definition";a:2:{s:4:"type";s:15:"field_item:uuid";s:8:"settings";a:3:{s:10:"max_length";i:128;s:8:"is_ascii";b:1;s:14:"case_sensitive";b:0;}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:4:"UUID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"read-only";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:4:"uuid";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:11:"revision_id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"integer";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:69;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:integer";s:8:"settings";a:6:{s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:3:"min";s:0:"";s:3:"max";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";}}}s:13:" * definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:11:"Revision ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"read-only";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:11:"revision_id";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:9:"workspace";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:16:"entity_reference";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:9:"target_id";a:3:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:13:"varchar_ascii";s:6:"length";i:255;}}s:7:"indexes";a:1:{s:9:"target_id";a:1:{i:0;s:9:"target_id";}}s:11:"unique keys";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:103;s:13:" * definition";a:2:{s:4:"type";s:27:"field_item:entity_reference";s:8:"settings";a:3:{s:11:"target_type";s:9:"workspace";s:7:"handler";s:7:"default";s:16:"handler_settings";a:0:{}}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:9:"workspace";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:40:"The workspace of the referenced content.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"required";b:1;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:9:"workspace";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:21:"target_entity_type_id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:6:"string";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:7:"varchar";s:6:"length";i:32;s:6:"binary";b:0;}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:141;s:13:" * definition";a:2:{s:4:"type";s:17:"field_item:string";s:8:"settings";a:3:{s:10:"max_length";i:32;s:8:"is_ascii";b:0;s:14:"case_sensitive";b:0;}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:22:"Content entity type ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:65:"The ID of the content entity type associated with this workspace.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"required";b:1;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:21:"target_entity_type_id";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:16:"target_entity_id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"integer";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:177;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:integer";s:8:"settings";a:6:{s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:3:"min";s:0:"";s:3:"max";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:17:"Content entity ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:60:"The ID of the content entity associated with this workspace.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"required";b:1;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:16:"target_entity_id";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:25:"target_entity_revision_id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"integer";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:3:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:216;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:integer";s:8:"settings";a:6:{s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:3:"min";s:0:"";s:3:"max";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";}}}s:13:" * definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:26:"Content entity revision ID";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:69:"The revision ID of the content entity associated with this workspace.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:8:"required";b:1;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:25:"target_entity_revision_id";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}s:16:"revision_default";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:" * type";s:7:"boolean";s:9:" * schema";a:4:{s:7:"columns";a:1:{s:5:"value";a:2:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";}}s:11:"unique keys";a:0:{}s:7:"indexes";a:0:{}s:12:"foreign keys";a:0:{}}s:10:" * indexes";a:0:{}s:17:" * itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:" * fieldDefinition";r:255;s:13:" * definition";a:2:{s:4:"type";s:18:"field_item:boolean";s:8:"settings";a:2:{s:8:"on_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:2:"On";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:9:"off_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:3:"Off";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}}}}s:13:" * definition";a:11:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:16:"Default revision";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:72:"A flag indicating whether this was a default revision when it was saved.";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:16:"storage_required";b:1;s:8:"internal";b:1;s:12:"translatable";b:0;s:12:"revisionable";b:1;s:8:"provider";s:10:"workspaces";s:10:"field_name";s:16:"revision_default";s:11:"entity_type";s:21:"workspace_association";s:6:"bundle";N;s:13:"initial_value";N;}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.entity_schema_data',
  'value' => 'a:2:{s:9:"workspace";a:2:{s:11:"primary key";a:1:{i:0;s:2:"id";}s:11:"unique keys";a:1:{s:22:"workspace__revision_id";a:1:{i:0;s:11:"revision_id";}}}s:18:"workspace_revision";a:2:{s:11:"primary key";a:1:{i:0;s:11:"revision_id";}s:7:"indexes";a:1:{s:13:"workspace__id";a:1:{i:0;s:2:"id";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.changed',
  'value' => 'a:2:{s:9:"workspace";a:1:{s:6:"fields";a:1:{s:7:"changed";a:2:{s:4:"type";s:3:"int";s:8:"not null";b:0;}}}s:18:"workspace_revision";a:1:{s:6:"fields";a:1:{s:7:"changed";a:2:{s:4:"type";s:3:"int";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.created',
  'value' => 'a:1:{s:9:"workspace";a:1:{s:6:"fields";a:1:{s:7:"created";a:2:{s:4:"type";s:3:"int";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.id',
  'value' => 'a:2:{s:9:"workspace";a:1:{s:6:"fields";a:1:{s:2:"id";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:1;}}}s:18:"workspace_revision";a:1:{s:6:"fields";a:1:{s:2:"id";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:1;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.label',
  'value' => 'a:2:{s:9:"workspace";a:1:{s:6:"fields";a:1:{s:5:"label";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:0;}}}s:18:"workspace_revision";a:1:{s:6:"fields";a:1:{s:5:"label";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.revision_default',
  'value' => 'a:1:{s:18:"workspace_revision";a:1:{s:6:"fields";a:1:{s:16:"revision_default";a:3:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.revision_id',
  'value' => 'a:2:{s:9:"workspace";a:1:{s:6:"fields";a:1:{s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}s:18:"workspace_revision";a:1:{s:6:"fields";a:1:{s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:1;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.uid',
  'value' => 'a:1:{s:9:"workspace";a:2:{s:6:"fields";a:1:{s:3:"uid";a:4:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;}}s:7:"indexes";a:1:{s:31:"workspace_field__uid__target_id";a:1:{i:0;s:3:"uid";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace.field_schema_data.uuid',
  'value' => 'a:1:{s:9:"workspace";a:2:{s:6:"fields";a:1:{s:4:"uuid";a:4:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:1;}}s:11:"unique keys";a:1:{s:28:"workspace_field__uuid__value";a:1:{i:0;s:4:"uuid";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.entity_schema_data',
  'value' => 'a:2:{s:21:"workspace_association";a:2:{s:11:"primary key";a:1:{i:0;s:2:"id";}s:11:"unique keys";a:1:{s:34:"workspace_association__revision_id";a:1:{i:0;s:11:"revision_id";}}}s:30:"workspace_association_revision";a:2:{s:11:"primary key";a:1:{i:0;s:11:"revision_id";}s:7:"indexes";a:1:{s:25:"workspace_association__id";a:1:{i:0;s:2:"id";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.id',
  'value' => 'a:2:{s:21:"workspace_association";a:1:{s:6:"fields";a:1:{s:2:"id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:1;}}}s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:2:"id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:1;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.revision_default',
  'value' => 'a:1:{s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:16:"revision_default";a:3:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.revision_id',
  'value' => 'a:2:{s:21:"workspace_association";a:1:{s:6:"fields";a:1:{s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:1;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.target_entity_id',
  'value' => 'a:2:{s:21:"workspace_association";a:1:{s:6:"fields";a:1:{s:16:"target_entity_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:16:"target_entity_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.target_entity_revision_id',
  'value' => 'a:2:{s:21:"workspace_association";a:1:{s:6:"fields";a:1:{s:25:"target_entity_revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:25:"target_entity_revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:0;s:4:"size";s:6:"normal";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.target_entity_type_id',
  'value' => 'a:2:{s:21:"workspace_association";a:1:{s:6:"fields";a:1:{s:21:"target_entity_type_id";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:32;s:6:"binary";b:0;s:8:"not null";b:0;}}}s:30:"workspace_association_revision";a:1:{s:6:"fields";a:1:{s:21:"target_entity_type_id";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:32;s:6:"binary";b:0;s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.uuid',
  'value' => 'a:1:{s:21:"workspace_association";a:2:{s:6:"fields";a:1:{s:4:"uuid";a:4:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:1;}}s:11:"unique keys";a:1:{s:40:"workspace_association_field__uuid__value";a:1:{i:0;s:4:"uuid";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'workspace_association.field_schema_data.workspace',
  'value' => 'a:2:{s:21:"workspace_association";a:2:{s:6:"fields";a:1:{s:9:"workspace";a:4:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:13:"varchar_ascii";s:6:"length";i:255;s:8:"not null";b:0;}}s:7:"indexes";a:1:{s:33:"workspace_association__c81ded43bf";a:1:{i:0;s:9:"workspace";}}}s:30:"workspace_association_revision";a:2:{s:6:"fields";a:1:{s:9:"workspace";a:4:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:13:"varchar_ascii";s:6:"length";i:255;s:8:"not null";b:0;}}s:7:"indexes";a:1:{s:33:"workspace_association__c81ded43bf";a:1:{i:0;s:9:"workspace";}}}}',
))
->execute();

// Create the entity tables for the 'workspace' and 'workspace_association'
// entity types.
$connection->schema()->createTable('workspace', array(
  'fields' => array(
    'id' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '128',
    ),
    'revision_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'uuid' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '128',
    ),
    'uid' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'label' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '128',
    ),
    'changed' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
    'created' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
  ),
  'primary key' => array(
    'id',
  ),
  'unique keys' => array(
    'workspace_field__uuid__value' => array(
      'uuid',
    ),
    'workspace__revision_id' => array(
      'revision_id',
    ),
  ),
  'indexes' => array(
    'workspace_field__uid__target_id' => array(
      'uid',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));
$connection->schema()->createTable('workspace_revision', array(
  'fields' => array(
    'id' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '128',
    ),
    'revision_id' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'label' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '128',
    ),
    'changed' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
    'revision_default' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
    ),
  ),
  'primary key' => array(
    'revision_id',
  ),
  'indexes' => array(
    'workspace__id' => array(
      'id',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));

$connection->schema()->createTable('workspace_association', array(
  'fields' => array(
    'id' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'revision_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'uuid' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '128',
    ),
    'workspace' => array(
      'type' => 'varchar_ascii',
      'not null' => FALSE,
      'length' => '255',
    ),
    'target_entity_type_id' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '32',
    ),
    'target_entity_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
    'target_entity_revision_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
  ),
  'primary key' => array(
    'id',
  ),
  'unique keys' => array(
    'workspace_association_field__uuid__value' => array(
      'uuid',
    ),
    'workspace_association__revision_id' => array(
      'revision_id',
    ),
  ),
  'indexes' => array(
    'workspace_association__c81ded43bf' => array(
      'workspace',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));
$connection->schema()->createTable('workspace_association_revision', array(
  'fields' => array(
    'id' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'revision_id' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'workspace' => array(
      'type' => 'varchar_ascii',
      'not null' => FALSE,
      'length' => '255',
    ),
    'target_entity_type_id' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '32',
    ),
    'target_entity_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
    'target_entity_revision_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
    ),
    'revision_default' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
    ),
  ),
  'primary key' => array(
    'revision_id',
  ),
  'indexes' => array(
    'workspace_association__id' => array(
      'id',
    ),
    'workspace_association__c81ded43bf' => array(
      'workspace',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));

// Create three workspaces: 'live', 'stage' and 'dev'.
$connection->insert('workspace')
->fields(array(
  'id',
  'revision_id',
  'uuid',
  'uid',
  'label',
  'changed',
  'created',
))
->values(array(
  'id' => 'live',
  'revision_id' => '1',
  'uuid' => 'fd27029c-147e-4a78-9bc1-bb5abb7ac51a',
  'uid' => '1',
  'label' => 'Live',
  'changed' => '1562256965',
  'created' => '1562256965',
))
->values(array(
  'id' => 'stage',
  'revision_id' => '2',
  'uuid' => '9f282ad7-ccfc-4091-8424-fb2b4c0e6d2a',
  'uid' => '1',
  'label' => 'Stage',
  'changed' => '1562256965',
  'created' => '1562256965',
))
->values(array(
  'id' => 'dev',
  'revision_id' => '3',
  'uuid' => '1d6ee186-4b32-4731-8e82-c0b8d08bbc04',
  'uid' => '1',
  'label' => 'Dev',
  'changed' => '1562257080',
  'created' => '1562257080',
))
->execute();
$connection->insert('workspace_revision')
->fields(array(
  'id',
  'revision_id',
  'label',
  'changed',
  'revision_default',
))
->values(array(
  'id' => 'live',
  'revision_id' => '1',
  'label' => 'Live',
  'changed' => '1562256965',
  'revision_default' => '1',
))
->values(array(
  'id' => 'stage',
  'revision_id' => '2',
  'label' => 'Stage',
  'changed' => '1562256965',
  'revision_default' => '1',
))
->values(array(
  'id' => 'dev',
  'revision_id' => '3',
  'label' => 'Dev',
  'changed' => '1562257080',
  'revision_default' => '1',
))
->execute();

// Create the following workspace associations:
// - stage: nid: 1, vid: 2
// - dev: nid 8, vid: 9
// - dev: nid 8, vid: 10
$connection->insert('workspace_association')
->fields(array(
  'id',
  'revision_id',
  'uuid',
  'workspace',
  'target_entity_type_id',
  'target_entity_id',
  'target_entity_revision_id',
))
->values(array(
  'id' => '1',
  'revision_id' => '1',
  'uuid' => '27e01013-3c4c-40c2-a336-67c938bdac41',
  'workspace' => 'stage',
  'target_entity_type_id' => 'node',
  'target_entity_id' => '1',
  'target_entity_revision_id' => '2',
))
->values(array(
  'id' => '2',
  'revision_id' => '3',
  'uuid' => '88d12be1-417e-4645-afdd-1f80419e36fa',
  'workspace' => 'dev',
  'target_entity_type_id' => 'node',
  'target_entity_id' => '8',
  'target_entity_revision_id' => '10',
))
->execute();

$connection->insert('workspace_association_revision')
->fields(array(
  'id',
  'revision_id',
  'workspace',
  'target_entity_type_id',
  'target_entity_id',
  'target_entity_revision_id',
  'revision_default',
))
->values(array(
  'id' => '1',
  'revision_id' => '1',
  'workspace' => 'stage',
  'target_entity_type_id' => 'node',
  'target_entity_id' => '1',
  'target_entity_revision_id' => '2',
  'revision_default' => '1',
))
->values(array(
  'id' => '2',
  'revision_id' => '2',
  'workspace' => 'dev',
  'target_entity_type_id' => 'node',
  'target_entity_id' => '8',
  'target_entity_revision_id' => '9',
  'revision_default' => '1',
))
->values(array(
  'id' => '2',
  'revision_id' => '3',
  'workspace' => 'dev',
  'target_entity_type_id' => 'node',
  'target_entity_id' => '8',
  'target_entity_revision_id' => '10',
  'revision_default' => '1',
))
->execute();
