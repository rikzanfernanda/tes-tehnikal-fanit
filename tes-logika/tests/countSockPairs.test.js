import countSockPairs from '../src/countSockPairs'

describe('Hitung jumlah pasang kaos kaki yang dapat dijual oleh sales', () => {
    test('should return 3', () => {
        expect(countSockPairs([10, 20, 20, 10, 10, 30, 50, 10, 20])).toBe(3)
    })

    test('should return 6', () => {
        expect(
            countSockPairs([6, 5, 2, 3, 5, 2, 2, 1, 1, 5, 1, 3, 3, 3, 5])
        ).toBe(6)
    })

    test('should return 4', () => {
        expect(countSockPairs([1, 1, 3, 1, 2, 1, 3, 3, 3, 3])).toBe(4)
    })
})
