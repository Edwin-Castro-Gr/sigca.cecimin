---
applyTo: "_js/**/*.js"
description: "Guidelines for JavaScript files in SIGCA: AJAX patterns, jQuery usage, and frontend conventions"
---

# JavaScript Instructions for SIGCA

## AJAX Patterns
- Use jQuery `$.post()` for AJAX calls to controller methods
- Always include CSRF tokens if enabled
- Handle responses as HTML strings for dynamic updates
- Check for errors and display user-friendly messages

## Code Style
- Mirror controller names for file organization
- Use descriptive variable names
- Include comments for complex logic

## Best Practices
- Avoid global variables; use closures
- Validate user input on client-side before AJAX
- Use Bootstrap modals for confirmations and alerts

## Security
- Never expose sensitive data in client-side code
- Sanitize data before DOM manipulation