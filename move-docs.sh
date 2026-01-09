#!/bin/bash

# Script to move all documentation files to documentation folder
# Run this script from the project root directory

echo "Moving documentation files to documentation/ folder..."

# Create documentation directory if it doesn't exist
mkdir -p documentation

# Move main documentation files (rename for consistency)
[ -f "API_DOCUMENTATION.md" ] && mv -v API_DOCUMENTATION.md documentation/API.md
[ -f "DATABASE_DOCUMENTATION.md" ] && mv -v DATABASE_DOCUMENTATION.md documentation/DATABASE.md
[ -f "DEPLOYMENT_GUIDE.md" ] && mv -v DEPLOYMENT_GUIDE.md documentation/DEPLOYMENT.md
[ -f "TESTING_DOCUMENTATION.md" ] && mv -v TESTING_DOCUMENTATION.md documentation/TESTING.md

# Move system documentation files
[ -f "HOW_IT_WORKS.md" ] && mv -v HOW_IT_WORKS.md documentation/
[ -f "ROLES_AND_PERMISSIONS.md" ] && mv -v ROLES_AND_PERMISSIONS.md documentation/
[ -f "EMAIL_FLOW_PLAN.md" ] && mv -v EMAIL_FLOW_PLAN.md documentation/
[ -f "FIELD_MAPPING_UPDATE.md" ] && mv -v FIELD_MAPPING_UPDATE.md documentation/

# Move project management files
[ -f "TODO.md" ] && mv -v TODO.md documentation/
[ -f "USERS.md" ] && mv -v USERS.md documentation/
[ -f "plan.md" ] && mv -v plan.md documentation/

# Move test reports
[ -f "test_report_2025-12-02_07-56-18.md" ] && mv -v test_report_2025-12-02_07-56-18.md documentation/

# Clean up instruction files
[ -f "MOVE_DOCS_INSTRUCTIONS.md" ] && rm -v MOVE_DOCS_INSTRUCTIONS.md

echo ""
echo "✅ Documentation organization complete!"
echo ""
echo "📁 Files in documentation/ folder:"
ls -lh documentation/

echo ""
echo "📝 Main README.md kept in root directory for GitHub"
echo "🗑️  Temporary instruction files removed"
