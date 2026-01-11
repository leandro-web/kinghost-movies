export const tmdbGenres = {
  12: "Aventura",
  14: "Fantasia",
  16: "Animação",
  18: "Drama",
  27: "Terror",
  28: "Ação",
  35: "Comédia",
  36: "História",
  80: "Crime",
  99: "Documentário",
  878: "Ficção Científica",
  10402: "Música",
  10749: "Romance",
  10751: "Família",
  10752: "Guerra",
  10770: "Cinema TV",
};

export const getGenreNames = (genreIds) => {
  if (!genreIds || !genreIds.length) return [];
  return genreIds.map((id) => tmdbGenres[id]).filter(Boolean);
};
