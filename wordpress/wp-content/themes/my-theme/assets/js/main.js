let buttonGamburger = document.querySelector('.gamburger');


let siteNav = document.querySelector('.invisible-site-nav')
let siteNavBackground = document.querySelector('.invisible-site-nav-background');

buttonGamburger.addEventListener('click', () => {
    siteNavBackground.classList.toggle('invisible-site-nav-background_active');
    siteNav.classList.toggle('invisible-site-nav_active');
    document.querySelector('html').classList.toggle('overflow-hidden');
})

let links = siteNav.querySelectorAll('a');

for (const link of links) {
	link.addEventListener('click', () => {
		siteNav.classList.remove('invisible-site-nav_active');
		siteNavBackground.classList.remove('invisible-site-nav-background_active')
		document.querySelector('html').classList.remove('overflow-hidden');

	})
}


let redirectStatus = getCookie('status');
if (redirectStatus == 'ok') {
	Swal.fire({
		icon: 'success',
		title: 'Данные были отправлены',
		text: 'В течении 10 минут с вами свяжется наш оператор',
	});
}
if (redirectStatus == 'error') {
	Swal.fire({
		icon: 'error',
		title: 'Вы ввели некорректные данные',
		text: 'Или произошла ошибка на сервере. Попробуйте позже',
	});
}
deleteCookie('status');












//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJqcy9tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImxldCBidXR0b25HYW1idXJnZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuZ2FtYnVyZ2VyJyk7XG5cbmJ1dHRvbkdhbWJ1cmdlci5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuaW52aXNpYmxlLXNpdGUtbmF2LWJhY2tncm91bmQnKS5jbGFzc0xpc3QudG9nZ2xlKCdpbnZpc2libGUtc2l0ZS1uYXYtYmFja2dyb3VuZF9hY3RpdmUnKTtcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuaW52aXNpYmxlLXNpdGUtbmF2JykuY2xhc3NMaXN0LnRvZ2dsZSgnaW52aXNpYmxlLXNpdGUtbmF2X2FjdGl2ZScpO1xuICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnRvZ2dsZSgnb3ZlcmZsb3ctaGlkZGVuJyk7XG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignaHRtbCcpLmNsYXNzTGlzdC50b2dnbGUoJ292ZXJmbG93LWhpZGRlbicpO1xufSkiXSwiZmlsZSI6ImpzL21haW4uanMifQ==
