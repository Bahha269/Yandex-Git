ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map('map', {
            center: [55.753994, 37.622093],
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        });
ymaps.geocode(myMap.getCenter(), {
        *@see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        kind: 'metro',
        results: 20
    }).then(function (res) {
            // Задаем изображение для иконок меток.
            res.geoObjects.options.set('preset', 'islands#redCircleIcon');
            res.geoObjects.events
                .add('mouseenter', function (event) {
                    var geoObject = event.get('target');
                    myMap.hint.open(geoObject.geometry.getCoordinates(), geoObject.getPremise());
                })
                .add('mouseleave', function (event) {
                    myMap.hint.close(true);
                });
            myMap.geoObjects.add(res.geoObjects);
            myMap.setBounds(res.geoObjects.getBounds());
        });
}