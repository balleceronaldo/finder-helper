lat = document.getElementById('lat').value;
lng = document.getElementById('lng').value;

var view = new ol.View({
  projection: 'EPSG:4326',
  center: [121.5,15],
  zoom: 5
});


var OSM = new ol.layer.Tile({
  type: 'base',
  title: 'Road On Demand',
  visible: true,
  source: new ol.source.BingMaps({
    imagerySet: 'RoadOnDemand',
    key: 'Ag7DSkKr-xwKNkS_dRyQ51O-e5Wz7ca-Fz2mzu6vtWPm1YxbIE6eFcYgXgMMUM4X'
  })
});

var satellite = new ol.layer.Tile({
  type: 'base',
  title: 'Aerial with Labels',
  visible: true,
  source: new ol.source.BingMaps({
    imagerySet: 'AerialWithLabelsOnDemand',
    key: 'Ag7DSkKr-xwKNkS_dRyQ51O-e5Wz7ca-Fz2mzu6vtWPm1YxbIE6eFcYgXgMMUM4X'
  })
});

var base_maps = new ol.layer.Group({
  title: 'Base Maps',
  layers: [OSM,satellite]
})

var map = new ol.Map({
  target: 'map',
  view: view
});

map.addLayer(base_maps);

var layerSwitcher = new ol.control.LayerSwitcher({
activationMode: 'click',
startActive: false,
tipLabel: 'Layers',
groupSelectStyle: 'children',
collapseTipLabel: 'Collapse Layer'

});
map.addControl(layerSwitcher);
layerSwitcher.renderPanel();
lat = document.getElementById('lat').value;
lng = document.getElementById('lng').value;
// const map = new ol.Map({
//   layers: layers,
//   // Improve user experience by loading tiles while dragging/zooming. Will make
//   // zooming choppy on mobile or slow devices.
//   loadTilesWhileInteracting: true,
//   target: 'map',
//   view: new ol.View({
//     projection:'EPSG:4326',
//     center: [lat, lng],
//     zoom: 18
//   })
// });




// var Style = new ol.style.Style({
//   image: new ol.style.Circle({
//     radius: 7,
//     fill: new ol.style.Fill({
//       color: '#ff0000'
//     })
//   })
// })

var Style = new ol.style.Style({
  image: new ol.style.Icon({
    anchor: [0,0],
    src: 'img/marker3.png'
  })
})



const marker = new ol.Feature({
  geometry: new ol.geom.Point([lat, lng]),
  type: 'icon',
  name: 'test'
})

var vectorLayer = new ol.layer.Vector({
  title: 'POI',
  source: new ol.source.Vector({
    features: [marker]
  }),
  style: Style
})


map.addLayer(vectorLayer)