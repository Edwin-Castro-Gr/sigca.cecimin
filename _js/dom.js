const DOM = function(){

 this.id = str => document.getElementById(str);
    
    this.query = (regla_css, one = false) =>
        one ? 
            document.querySelector(regla_css) : 
            document.querySelectorAll(regla_css);

    this.create = (str, props = {}) => {
        const element = document.createElement(str);
        return Object.assign(element, props);
    };

    this.append = (hijos, padre = document.body) => {
        if (Array.isArray(hijos) || hijos instanceof NodeList) {
            hijos.forEach(hijo => padre.appendChild(hijo));
        } else {
            padre.appendChild(hijos);
        }
    };

    this.remove = e => {
        if (e && e.parentNode) {
            e.remove();
        }
    };
}
const D = new DOM();