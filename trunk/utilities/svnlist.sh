#!/bin/bash

# should use svn:property instead of this!

svn status | grep ^? | \
grep -v 'cache' | \
grep -v 'web/uploads' | \
grep -v 'web/images/sources' | \
grep -v 'apps/frontend/config/app.yml' | \
grep -v 'apps/backend/config/app.yml' | \
grep -v 'apps/frontend/config/factories.yml' | \
grep -v 'apps/backend/config/factories.yml' | \
grep -v 'config/databases.yml' | \
grep -v 'config/schoolmesh.rc' | \
grep -v 'data/documents/forms.yml' | \
grep -v 'data/documents/testo.pdf' | \
grep -v 'data/documents/main.yml' | \
grep -v 'data/documents/quality.yml' | \
grep -v 'utilities/fixauthor.sh' | \
grep -v 'templates/email/document_submission.yml$' | \
grep -v 'templates/email/document_approval.yml$' | \
grep -v 'templates/email/document_rejection.yml$' | \
grep -v 'templates/email/email_change_confirmation.yml$' | \
grep -v 'templates/email/project_alert.yml' | \
grep -v 'templates/oo/workplan20.odt$' | \
grep -v 'templates/oo/workplan30.odt$' | \
grep -v 'templates/oo/workplan40.odt$' | \
grep -v 'templates/oo/workplan50.odt$' | \
grep -v 'templates/oo/workplan60.odt$' | \
grep -v 'templates/oo/workplan70.odt$' | \
grep -v 'templates/oo/workplan80.odt$' | \
grep -v 'templates/oo/workplan90.odt$' | \
grep -v 'data/attachments' | \
grep -v 'templates/oo/welcomeletter_allievi.odt$' | \
grep -v 'templates/oo/recuperation.odt$' | \
sed 's/^?      //'
