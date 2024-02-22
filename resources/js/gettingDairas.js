const dairaSelect = document.getElementById('dairaSelect');
const regionSelect = document.getElementById('regionSelect');

const [html] = document.getElementsByTagName("html")
const lang = html.getAttribute("lang");

const getDairas = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var dairas = JSON.parse(this.responseText);

            if(lang === 'ar'){
                dairaSelect.innerHTML = '<option selected hidden style="display:none" value="">الدائرة</option>';
            } else if(lang === 'fr'){
                dairaSelect.innerHTML = '<option selected hidden style="display:none" value="">Daira</option>';
            }

            dairas.forEach(element => {
                const option = document.createElement("option");
                option.value = element.id;
                option.text = element.name;
                dairaSelect.add(option);
                dairaSelect.removeAttribute("disabled");
            });
        }
    };
    var region = regionSelect.value;
    xhttp.open("GET",  `/${lang}/api/dairas/` + region, true);
    xhttp.send();
}

if(regionSelect.value){
    getDairas()
}

regionSelect.addEventListener('change', getDairas);
