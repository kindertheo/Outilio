const camelToPascal = (camelCase) => {
    return camelCase
        .replace(/([A-Z])/g, (match) => `${match}`)
        .replace(/^./, (match) => match.toUpperCase())
        .trim();
}

export default camelToPascal;
