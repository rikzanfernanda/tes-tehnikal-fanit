import countWords from '../src/countWords'

describe('Hitung jumlah kata pada sebuah kalimat', () => {
    test('should return 5', () => {
        expect(
            countWords('Saat meng*ecat tembok, Agung dib_antu oleh Raihan.')
        ).toBe(5)
    })

    test('should return 3', () => {
        expect(countWords('Berapa u(mur minimal[ untuk !mengurus ktp?')).toBe(3)
    })

    test('should return 4', () => {
        expect(
            countWords(
                'Masing-masing anak mendap(atkan uang jajan ya=ng be&rbeda.'
            )
        ).toBe(4)
    })
})
