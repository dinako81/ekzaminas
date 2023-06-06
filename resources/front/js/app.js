import 'bootstrap';
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// kiekvienoj sekcijoj susirandam mygtuka, uzdedam eventlistener, kad mygtukas make click, kai button padaro click reikia nueiti ir susirastu sekcijoj inputus (vienam count, kitam product_id) ir pagal imput name irasome input value
document.querySelectorAll('.--add--to--cart').forEach(section => {
    section.querySelector('button').addEventListener('click', _ => {
        const data = {};
        section.querySelectorAll('input').forEach(input => {
            data[input.getAttribute('name')] = input.value;
        });

        axios.put(section.dataset.url, data)
            .then(res => {
                console.log(res.data);
                document.querySelector('.--count').innerText = res.data.count;
                document.querySelector('.--total').innerText = res.data.total.toFixed(2);
            });
    });
});

if (document.querySelector('.--top--cart')) {
    window.addEventListener('load', _ => {
        const url = document.querySelector('.--top--cart').dataset.url;
        axios.get(url)
            .then(res => {
                document.querySelector('.--count').innerText = res.data.count;
                document.querySelector('.--total').innerText = res.data.total.toFixed(2);
                document.querySelector('.--cart-info').style.opacity = 1;
            })
    })
}