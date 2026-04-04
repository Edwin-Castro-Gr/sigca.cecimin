# SIGCA Workspace Instructions

## Project Overview

SIGCA is a healthcare management system built with CodeIgniter 3.x, featuring multi-tenant architecture with separate MySQL databases per client. The application uses jQuery, Bootstrap 4.6, and AJAX for dynamic interactions.

## Architecture & Patterns

### MVC Structure
- **Controllers**: Located in `application/controllers/`, prefixed by function (A_=admin, C_=clinical, D_=docs, R_=reports, M_=modules)
- **Models**: Minimal usage; `General_model.php` provides universal CRUD operations
- **Views**: Organized by module, rendered through `template.php` master layout

### Key Patterns
- **Session Management**: User data stored with `C_` prefix (e.g., `C_id_usuario`, `C_basedatos`)
- **Database Selection**: Dynamic DB switching via `$this->db->query('USE '.$this->session->userdata('C_basedatos'))`
- **AJAX Security**: Check `is_ajax_request()` before processing POST requests
- **Authentication**: Constructor-level checks redirecting to login if `C_id_usuario` empty

## Development Conventions

### Code Style
- Use CodeIgniter's conventions: class names capitalized, methods lowercase
- Include timezone setting: `date_default_timezone_set('America/Bogota')`
- Load views via template: `$this->load->view('template', $data)`

### Database
- Schema defined in `DB_sigca.sql`
- Use Query Builder over raw SQL to prevent injection
- Wrap transactions with `trans_start()` and `trans_complete()`

### Frontend
- JavaScript files in `_js/` mirror controller names
- AJAX calls use jQuery POST to controller methods
- No build process; scripts included directly in `template.php`

## Security Considerations

### Critical Issues
- **SQL Injection**: Many queries use string concatenation; refactor to Query Builder
- **Hardcoded Secrets**: Database credentials and encryption keys exposed in config
- **Weak Encryption**: `AES_ENCRYPT()` with visible keys; consider stronger alternatives
- **CSRF Protection**: Form validation loaded but CSRF unclear; enable if needed

### Best Practices
- Always validate user input
- Use prepared statements for dynamic queries
- Audit session data before database operations
- Implement proper error handling

## Build & Environment

- No build system; manual deployment
- Environment controlled by `CI_ENV` variable
- Composer used for DOMPDF library
- Production URL: `https://sigca.cecimin.com.co/`

## Existing Customizations

- **Agent**: [Senior PHP Architect](.github/agents/senior-php-architect.agent.md) - For expert CodeIgniter development
- **Skill**: [skill-fullstack](.github/skills/skill-fullstack/SKILL.md) - Workflow for debugging, implementation, and code review

## Common Pitfalls

- Multi-tenant data leaks via improper session validation
- Inconsistent transaction handling
- No automated tests; manual verification required
- Heavy reliance on raw SQL; migrate to ORM patterns

## Getting Started

1. Set up local MySQL with schema from `DB_sigca.sql`
2. Configure database credentials in `application/config/database.php`
3. Set `CI_ENV` for environment-specific configs
4. Access via `index.php` (default route: login)

For detailed analysis, see repository memory or consult the Senior PHP Architect agent.</content>
<parameter name="filePath">d:\GIT\CECIMIN\sigca.cecimin\.github\copilot-instructions.md