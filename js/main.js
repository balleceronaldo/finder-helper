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

// Adding Custom Marker on the map
var Style = new ol.style.Style({
  image: new ol.style.Icon({
    anchor: [0, 0],
    anchorXUnits: 'fraction',
    anchorYUnits: 'pixels',
    src: 'img/marker3.png',
  }),
});

var marker = new ol.Feature({
  geometry: new ol.geom.Point([121.5,15]),
  type: 'hospital',
  name: 'test'
})

var vectorLayer = new ol.layer.Vector({
  title: 'POI',
  source: new ol.source.Vector({
    features: [marker]
  }),
  style: Style
})

map.addLayer(vectorLayer);

