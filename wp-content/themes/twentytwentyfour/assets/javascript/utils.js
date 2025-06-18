function checkUrl(url) {
  return fetch(url)
    .then((response) => response.ok)
    .catch((error) => false);
}

function slugify(str) {
  str = str.trim().toLowerCase();

  // Optional: convert accented characters to ASCII equivalents
  str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

  // Replace unwanted characters with dash
  str = str.replace(/[^a-z0-9]+/g, "-");

  // Collapse multiple dashes
  str = str.replace(/-+/g, "-");

  // Trim leading and trailing dashes
  str = str.replace(/^-+|-+$/g, "");

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
