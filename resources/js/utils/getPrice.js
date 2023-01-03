const getPrice = (price) => {
    return new Intl.NumberFormat("fr-FR", {
        style: "currency",
        currency: "EUR",
    }).format(price / 100);
};

export default getPrice;
