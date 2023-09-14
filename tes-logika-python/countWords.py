def count_words(sentence):
    special_chars = ['*', '_', '!', '=', '[', ']', '(', ')', '{', '}', '&', '@', '#', '$', '%', '^', '+', '<', '>']

    words = sentence.split()

    count = 0

    for word in words:
        for char in word:
            if char in special_chars:
                count += 1
                break

    return len(words) - count

def main():
    string = input('Masukkan kalimat, e.g "Kemarin Shopia per[gi ke mall.": ')

    print(count_words(string))
    
if __name__ == '__main__':
    main()