const countSockPairs = (socks) => {
    const sockCounts = {}
    let pairCount = 0

    for (const sock of socks) {
        if (sockCounts[sock]) {
            sockCounts[sock]++
        } else {
            sockCounts[sock] = 1
        }
    }

    for (const count of Object.values(sockCounts)) {
        pairCount += Math.floor(count / 2)
    }

    return pairCount
}

export default countSockPairs
