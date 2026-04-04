---
applyTo: "application/controllers/**/*.php"
description: "Security and best practices for CodeIgniter controllers in SIGCA"
---

# PHP Controller Instructions

## Authentication & Authorization
- Always check session in constructor: `if(!$this->session->userdata('C_id_usuario')) redirect('login')`
- Validate user permissions for admin actions
- Use role-based access control where applicable

## Database Security
- Select tenant database: `$this->db->query('USE '.$this->session->userdata('C_basedatos'))`
- Use Query Builder instead of raw SQL to prevent injection
- Wrap transactions: `$this->db->trans_start()` and `$this->db->trans_complete()`

## AJAX Handling
- Check `if(!$this->input->is_ajax_request()) redirect()`
- Validate POST data: `$this->form_validation->run()`
- Return JSON or HTML responses appropriately

## Code Quality
- Include timezone: `date_default_timezone_set('America/Bogota')`
- Load views via template: `$this->load->view('template', $data)`
- Use meaningful variable names and comments

## Security Best Practices
- Never trust user input; always validate and sanitize
- Avoid hardcoded credentials; use config files
- Log security events for auditing