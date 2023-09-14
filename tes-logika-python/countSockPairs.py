def count_sock_pairs(socks):
    sock_counts = {}
    pair_count = 0

    for sock in socks:
        if sock in sock_counts:
            sock_counts[sock] += 1
        else:
            sock_counts[sock] = 1

    for count in sock_counts.values():
        pair_count += count // 2

    return pair_count

def main():
    socks = input('Masukkan nilai, e.g "1 2 3 4 5": ')
    number_strings = socks.split()

    numbers = [int(num) for num in number_strings]

    print(numbers)
    print(count_sock_pairs(numbers))
    
if __name__ == '__main__':
    main()