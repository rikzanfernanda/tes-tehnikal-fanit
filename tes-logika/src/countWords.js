function countWords(sentence) {
    const specialChars = ['*', '_', '!', '=', '[', ']', '(', ')', '{', '}', '&', '@', '#', '$', '%', '^', '+', '<', '>'];

    const words = sentence.split(' ');

    let count = 0;

    for (const word of words) {
        for (const char of word) {
            if (specialChars.includes(char)) {
                count++;
                break;
            }
        }
    }

    return words.length - count;
}

export default countWords