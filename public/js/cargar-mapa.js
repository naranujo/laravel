get_url = window.location.pathname;

if (get_url.includes("/es/") || get_url.includes("/en/") || get_url.includes("/pt/")) {
    url_imagen = "images/mapa.svg"
} else if (get_url.includes("/es")) {
    url_imagen = "images/mapa.svg"
} else if (get_url.includes("/en")) {
    url_imagen = "images/mapa.svg"
} else if (get_url.includes("/pt")) {
    url_imagen = "images/mapa.svg"
} else {
    url_imagen = "images/mapa.svg"
}


function loadSVG(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            callback(null, xhr.responseText);
        } else {
            callback(new Error(xhr.statusText), null);
        }
    };
    xhr.onerror = function() {
        callback(new Error('Network error'), null);
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    loadSVG(url_imagen, function(error, svg) {
        if (error) {
            console.error('Error cargando el SVG:', error);
            return;
        }

        // Insertar el SVG en el contenedor
        document.getElementById('svg-container').innerHTML = svg;

        // Seleccionar los elementos del SVG
        let pathSvg = document.querySelector('svg');

        // let Brasil = pathSvg.querySelector('#Brasil');
        let Uruguay = pathSvg.querySelector('#Uruguay');
        // let EstadosUnidos = pathSvg.querySelector('#EstadosUnidos');
        let Suiza = pathSvg.querySelector('#Suiza');
        let NuevaZelanda = pathSvg.querySelector('#NuevaZelanda');
        let Bvi = pathSvg.querySelector('#Bvi');

        let paises = [
            // Brasil,
            Uruguay,
            // EstadosUnidos,
            Suiza,
            NuevaZelanda,
            Bvi,
        ];

        let data = {
            Brasil : {
                direccion : 'Avenida Paulista, 1234',
                ciudad: 'São Paulo',
            },
            Uruguay : {
                direccion : '18 de Julio 841, Oficina 401',
                direccion2 : 'Paraguay 2141, Torre 3, Piso 1, Oficina 001',
                // ciudad: '(zona franca) Aguada Park (CP 11.800)',
                ciudad2: 'Montevideo',
            },
            // EstadosUnidos : {
            //     // direccion : 'Wyoming',
            //     // ciudad: 'Estados Unidos',
            // },
            Suiza : {
                direccion : 'Ginebra',
                // ciudad: 'Suiza',
            },
            NuevaZelanda : {
                direccion : 'Floor 3, 32 Mahuhu Crescent',
                ciudad: 'Auckland',
            },
            Bvi : {
                direccion : '3076 Sir Drake´s highway',
                ciudad: 'Road Town, Tortola',
            },
        }
        
        // Agregar evento mouseover a cada país
        paises.forEach(function(pais) {
            pais.addEventListener('mouseover', function() {
                let recuadro = document.createElement('div');
                let lista = document.createElement('ul');
                let direccion = document.createElement('li');
                let ciudad = document.createElement('li');

                if (this.id === 'Uruguay') {
                    let direccion2 = document.createElement('li');
                    let ciudad2 = document.createElement('li');

                    direccion2.style.margin = '0';
                    ciudad2.style.margin = '0';

                    direccion2.style.fontSize = '10pt';
                    ciudad2.style.fontSize = '10pt';

                    direccion2.textContent = data[this.id].direccion2;
                    ciudad2.textContent = data[this.id].ciudad2;

                    direccion.textContent = data[this.id].direccion;
                    ciudad.textContent = data[this.id].ciudad;

                    direccion.style.marginLeft = '10px';
                    direccion2.style.marginLeft = '10px';

                    ciudad.style.listStyle = 'none';
                    ciudad2.style.listStyle = 'none';

                    lista.appendChild(direccion);
                    lista.appendChild(direccion2);
                    lista.appendChild(ciudad);
                    lista.appendChild(ciudad2);
                } else {
                    direccion.textContent = data[this.id].direccion;
                    ciudad.textContent = data[this.id].ciudad;

                    lista.appendChild(direccion);
                    lista.appendChild(ciudad);
                }

                recuadro.classList.add('recuadro');

                lista.style.margin = '0';
                lista.style.padding = '0';
                if (this.id !== 'Uruguay') {
                    lista.style.listStyle = 'none';
                    direccion.style.margin = '0';
                }
                ciudad.style.margin = '0';
                
                direccion.style.fontSize = '10pt';
                ciudad.style.fontSize = '10pt';
                
                recuadro.style.position = 'fixed';
                recuadro.style.top = this.getBoundingClientRect().bottom + 'px';
                recuadro.style.left = this.getBoundingClientRect().left + 'px';

                recuadro.style.backgroundColor = '#FBFAF8';
                recuadro.style.border = '0.25px solid #A99C6B';
                recuadro.style.borderRadius = '10px';
                recuadro.style.padding = '5px';

                recuadro.appendChild(lista);

                document.body.appendChild(recuadro);
            });

            pais.addEventListener('mouseout', function() {
                let recuadro = document.querySelector('.recuadro');
                if (recuadro) {
                    recuadro.remove();
                }
            });
        });

    });
});