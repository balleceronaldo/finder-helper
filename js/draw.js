var view = new ol.View({
  projection: 'EPSG:4326',
  center: [121.5,15],
  zoom: 5
});

var OSM = new ol.layer.Tile({
  type: 'base',
  title: 'Road on Demand',
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

// clicking the map sends coordinate to input
map.addEventListener('click', function(e){
  document.getElementById('lat').value = e.coordinate[0]
  document.getElementById('lng').value = e.coordinate[1]
})

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


// draw interaction on the map - draw a yellow dot
var drawSource = new ol.source.Vector()

var drawLayer = new ol.layer.Vector({
  source:drawSource,
  style: new ol.style.Style({
    fill: new ol.style.Fill({
      color: 'rgba(255,255,255,0.2)',
    }),
    stroke: new ol.style.Stroke({
      color: 'rgba(170,1,20,0.2)',
      width: 10,
    }),
    image: new ol.style.Circle({
      radius: 7,
      fill: new ol.style.Fill({
        color: '#ffcc33'
      })
    })
  })
})
map.addLayer(drawLayer)
var drawPoint = new ol.interaction.Draw({
  source:drawSource, 
  type: 'Point',
})

// delete previous point drawing
drawPoint.on('drawend', function(e){
  drawSource.clear()
})

map.addInteraction(drawPoint)


