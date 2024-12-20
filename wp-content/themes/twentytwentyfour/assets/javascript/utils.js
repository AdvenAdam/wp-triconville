function checkUrl(url) {
  return fetch(url)
    .then((response) => response.ok)
    .catch((error) => false);
}

function slugify(str) {
  str = str.replace(/^\s+|\s+$/g, ""); // trim
  str = str.toLowerCase();

  // remove accents, swap  for "e", etc.
  var from = "  -_";
  var to = "  --";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9-]/g, " ").replace(/\s+/g, "-");

  return str;
}

function toTitleCase(str) {
  return str.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}

function filterProductName(str) {
  if (toTitleCase(str).includes("Vento Aluminium")) {
    return toTitleCase(str.replace("Vento Aluminium", "vento alu"));
  } else {
    return str;
  }
}
