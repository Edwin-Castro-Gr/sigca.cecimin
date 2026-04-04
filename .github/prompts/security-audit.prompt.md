---
name: security-audit
description: "Audit PHP CodeIgniter code for security vulnerabilities: SQL injection, XSS, CSRF, and authentication issues"
user-invocable: true
---

# Security Audit Prompt

Analyze the provided PHP CodeIgniter code for common security vulnerabilities:

1. **SQL Injection**: Check for raw SQL concatenation; recommend Query Builder
2. **XSS**: Verify output escaping in views
3. **CSRF**: Ensure CSRF tokens are used in forms
4. **Authentication**: Confirm session checks and proper redirects
5. **Data Exposure**: Audit for hardcoded secrets or sensitive data leaks
6. **Input Validation**: Check for proper sanitization

Provide a report with findings, severity levels, and refactoring suggestions.