---
name: skill-fullstack
description: '**WORKFLOW SKILL** — Handle full-stack PHP CodeIgniter development tasks including debugging issues, implementing features, and conducting code reviews. USE FOR: debugging PHP/CodeIgniter problems, implementing new functionalities, code review checklists. DO NOT USE FOR: non-PHP tasks, general coding questions. INVOKES: file system tools (read/write/edit files), run_in_terminal (for testing/building), subagents (for codebase exploration), ask-questions (for clarification).'
---

# skill-fullstack

## Overview

This skill provides a structured workflow for full-stack PHP CodeIgniter development, encompassing debugging, feature implementation, and code review processes.

## Decision Flow

Determine the task type:
- **Debugging**: Follow the debugging workflow
- **Feature Implementation**: Follow the implementation workflow
- **Code Review**: Follow the review workflow

## Debugging Workflow

1. **Gather Context**
   - Read error logs and relevant files
   - Identify the issue type (syntax, logic, database, etc.)

2. **Analyze Code**
   - Check for syntax errors using PHP linter
   - Review logic and potential bugs

3. **Test Fixes**
   - Apply fixes
   - Run tests or manual verification
   - Validate in browser or terminal

## Implementation Workflow

1. **Plan Feature**
   - Define requirements
   - Sketch architecture (controllers, models, views)

2. **Develop Code**
   - Write controllers, models, views
   - Implement business logic

3. **Test and Validate**
   - Unit tests
   - Integration tests
   - User acceptance

## Code Review Workflow

1. **Code Quality Checklist**
   - Follows CodeIgniter conventions
   - Proper MVC separation
   - Security best practices (CSRF, XSS prevention)

2. **Performance Check**
   - Efficient queries
   - No memory leaks

3. **Documentation**
   - Comments and PHPDoc

## Quality Criteria

- All code passes PHP syntax check
- No security vulnerabilities
- Features work as specified
- Code is maintainable and readable